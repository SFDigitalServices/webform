<?php
namespace App\Http\Controllers;

use App\Form;
use Auth;
use Log;
use App\User;
use App\User_Form;
use Validator;
use App\Helpers\UserHelper;
use App\Helpers\ListHelper;
use App\Helpers\HTMLHelper;
use App\Helpers\DataStoreHelper;
use App\Helpers\ControllerHelper;
use App\Http\Controllers\EmailController;


use Illuminate\Http\Request;

class FormController extends Controller
{
    protected $htmlHelper;
    protected $controllerHelper;
    protected $dataStoreHelper;
    protected $emailController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // defines operations that need to be protected
        $this->middleware('auth', ['only' =>
          [
            'create',
            'save',
            'clone',
            'getUserForms',
            'getForm',
            'getFilename',
            'share',
            'getAuthors',
            'purgeCSV',
            'exportFormData'
          ]]);
        $this->controllerHelper = new ControllerHelper();
        $this->dataStoreHelper = new DataStoreHelper();
        $this->htmlHelper = new HTMLHelper();
        $this->emailController = new EmailController();
    }

     /** Provide API to obtain user api token.
     *  This is expected to change when SSO is available.
     */
    public static function getApiToken(Request $request)
    {
        return UserHelper::getApiToken($request->input('email'), $request->input('password'));
    }

    /** Gets all the forms for the current logged in user.
    *
    * @param $request
    *
    * @return json response
    */
    public function getUserForms(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = Auth::user()->where('id', $user_id)->get();
        $forms = Form::all();
        $user_forms = User_Form::all();
        $query = User_Form::select('form_id')->where('user_id', $user_id)->get();

        $forms = Form::whereIn('id', $query)->get();

        foreach ($forms as $key => $value) {
            $forms[$key]['content'] = $this->controllerHelper->scrubString($value['content']);
            $forms[$key]['content'] = json_decode($value['content'], true); //hack to convert json blob to part of larger object
        }

        return response()->json($forms);
    }

   /** Gets a form for the current logged in user.
    *
    * @param $request
    *
    * @return json response
    */
    public function getForm(Request $request)
    {
        $form_id = $request->input('form_id');
        $form = Form::where('id', $form_id)->first();
        $form['content'] = $this->controllerHelper->scrubString($form['content']);

        return $form ? response()->json($form) : response()->json(['status' => 'failed']);
    }

    /** Saves the edited form for the current logged in user. Saves the form_table
    *
    * @param $request
    *
    * @return bool
    */
    public function save(Request $request)
    {
        $form_id = $request->input('id');
        if ($form_id == 0) {
            return $this->create($request);
        } else {
            $returnForm = Form::where('id', $form_id)->first();
            $returnForm['content'] = $this->controllerHelper->scrubString($request->input('content'));
            $previousContent = array();
            $previousContent['data'] = json_decode($request->input('previousContent'),true);

            $returnForm->save();
            //update form table
            $definitions = json_decode($returnForm['content'], true);
            //if (isset($definitions['settings']['backend']) && $definitions['settings']['backend'] == "csv") {
                //sanitize form data, "name" is missing from some fields. This isn't necessary if DFB-374 gets fixed.
                if (!empty($definitions['data'])) {
                  $count = count($definitions['data']);
                  for ($i = 0; $i < $count; $i++) {
                      if (! isset($definitions['data'][$i]['name'])) {
                          $definitions['data'][$i]['name'] = $definitions['data'][$i]['id'];
                      }
                  }
              }
              if (!empty($previousContent['data'])) {
                  $count = count($previousContent['data']);
                  for ($i = 0; $i < $count; $i++) {
                      if (! isset($previousContent['data'][$i]['name'])) {
                          $previousContent['data'][$i]['name'] = $previousContent['data'][$i]['id'];
                      }
                  }
              }
              $updated_table = $this->dataStoreHelper->saveFormTableColumn('forms_'.$returnForm->id, $this->controllerHelper->getFormColumnsToUpdate($definitions, $previousContent));
              if (isset($updated_table['status']) && $updated_table['status'] == 0) {
                  return response()->json(['status' => 0, 'message' => 'Failed to update form table']);
              }
          //}
        }
        return response()->json($returnForm);
    }


    /** Clone from an existing form. Clones the form_table too?
    *
    * @param $request
    *
    * @return json response
    */
    public function clone(Request $request)
    {
        $user_id = $request->input('user_id');
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();

        if ($form) {
            $content = json_decode($form['content'], true);
            $content['settings']['name'] = "Clone of ".$content['settings']['name'];
            $cloned_form = Form::create(['content' => json_encode($content)]);

            if ($cloned_form) {
                // create entry in user_form
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $cloned_form->id]);
                if ($user_form) {
                    // clone the form table
                    $created_table = $this->dataStoreHelper->cloneFormTable("forms_".$form_id, "forms_".$cloned_form->id);
                    if( $created_table )
                      return response()->json(['status' => 1, 'data' => $user_form, 'message' => '']);
                    else
                      return response()->json(['status' => 0, 'data' => null, 'message' => 'Failed to create cloned form table']);
                }
            }
            return response()->json(['status' => 0, 'message' => 'Failed to clone form']);
        }
        return response()->json(['status' => 0, 'message' => 'Form doesn\'t exist']);
    }

   /** Share an existing form with another user.
    *
    * @param $request
    *
    * @return json response
    */
    public function share(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'email' => 'required|email'
        ]);

        $email = $request->input('email');
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();

        if (!$form) {
            return response()->json(['status' => 0, 'message' => 'Form doesn\'t exist']);
        } else {
            $user = UserHelper::getUserByEmail($email);
            if (!$user) {
                return response()->json(['status' => 0, 'message' => $email.' does not have an account.']);
            } else {
                $user_already_has_access = User_Form::where([['user_id','=', $user->id], ['form_id', '=', $form_id]])->first();
                if ($user_already_has_access) {
                    return response()->json(['status' => 0, 'message' => 'Form has already been shared with '.$user->name.'.']);
                } else {
                    $user_form = User_Form::create(['user_id' => $user->id, 'form_id' => $form_id]);
                    if ($user_form) {
                        $authors = UserHelper::formatAuthors(UserHelper::getFormUsers($form_id));
                        return response()->json(['status' => 1, 'message' => 'Form shared with '.$user->name.'.', 'data' => $authors]);
                    } else {
                        return response()->json(['status' => 0, 'message' => 'Failed to share form']);
                    }
                }
            }
        }
    }

    /** Provides a list of users attached to a form.
    *
    * @param $request
    *
    * @return string
    */
    public function getAuthors(Request $request)
    {
        $form_id = $request->input('id');
        return response()->json(['status' => 1, 'data' => UserHelper::formatAuthors(UserHelper::getFormUsers($form_id))]);
    }


    /** Creates a new form for the current logged in user. Creates the form_table
    *
    * @param $request
    *
    * @return json response
    */
    public function create(Request $request)
    {
        $form = Form::create(['content' => $this->controllerHelper->scrubString($request->input('content'))]);
        if ($form) {
            // create entry in user_form
            $user_id = $request->input('user_id');
            $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $form->id]);
            if ($user_form) {
                $returnForm = Form::where('id', $form->id)->first();
                $returnForm['content'] = json_decode($returnForm['content'], true);
                // create the form table
                $created_table = $this->dataStoreHelper->createFormTable('forms_'.$form->id, $returnForm['content']['data']);
                if ($created_table) {
                    return response()->json($returnForm);
                } else {
                    return response()->json(['status' => 0, 'message' => 'Created form but failed to create form table']);
                }
            }
        }
        return response()->json(['status' => 0, 'message' => 'Failed to create form']);
    }


    /** Creates a page preview of the form
    *
    * @param $request
    *
    * @return HTML
    */
    public function preview(Request $request)
    {
        $form_id = $request->input('id');

        $embedHTML = $this->embedJS($request);
        return '<!DOCTYPE html><html><head>'.
        '<meta name="viewport" content="width=device-width, initial-scale=1.0">'.
        '<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />'.
        '<link rel="stylesheet" href="//' . $request->getHttpHost() . '/assets/css/form-base.css" />'.
        '<link rel="stylesheet" href="//' . $request->getHttpHost() . '/assets/css/form-branding.css" />'.
        '<link rel="stylesheet" href="//' . $request->getHttpHost() . '/assets/css/form-preview.css" />'.
        '</head>'.
        '<body><div id="SFDSWF-Container"></div><script>'.$embedHTML.'</script><noscript>This form requires JavaScript. Please reload the page, or enable JavaScript in your browser.</noscript></body></html>';
    }

    /** Creates an embed JS for the form
    *
    * @param $request
    *
    * Creates a page preview of the submitted form
    *
    * @return HTML
    */
    public function previewSubmitted(Request $request)
    {
      $output = "<div style='padding:3em 4.5em'>".
			"<h2>Please set a Form Action before trying to embed your form.</h2>".
			"<h3>Below is a summary of what you just submitted:</h3>";
			foreach ($request->request->all() as $key => $value) {
        $val = is_array($value) ? implode(",", $value) : $value;
        $output .= $key . " = " . $val . "<br/>";
			}
      $output .= "</div>";
      return $output;
    }

    /**
    * Creates an embed JS for the form
    *
    * @return HTML
    */
    public function embedJS(Request $request)
    {
        $referer = $request->headers->get('referer');
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
				$form['content'] = $this->controllerHelper->scrubString($form['content']);
        $form['content'] = json_decode($form['content'], true);
        return $this->htmlHelper->wrapJS($form, $request->getHttpHost(), $referer);
    }


   /** Generates HTML from the form
    *
    * @param $request
    *
    * @return HTML
    */
    public function generate(Request $request)
    {
        $form_id = $request->input('id');
				$form = Form::where('id', $form_id)->first();
				$form['content'] = $this->controllerHelper->scrubString($form['content']);
				$form['content'] = json_decode($form['content'], true);
        return $this->htmlHelper->getHTML($form);
    }

    /** Deletes a form, removes the form_table
    *
    * @param $request
    *
    * @return json object
    */
    public function delete(Request $request)
    {
        $user_id = $request->input('user_id');
        $form_id = $request->input('id');

        // soft delete?
        // check permission
        $user_form_delete = User_Form::where([['user_id','=', $user_id], ['form_id', '=', $form_id]])->delete();
        if ($user_form_delete) { //check if no more users own that form, then delete
            $remaining_form_users = User_Form::where('form_id', $form_id)->first();
            if (!$remaining_form_users) {
                $form_delete = Form::where([['id', $form_id]])->delete();
                if ($form_delete) {
                    $deleted = $this->dataStoreHelper->deleteFormTable($form_id);
                    if( $deleted )
                        return response()->json(['status' => 1, 'message' => 'Deleted form from user']);
                    else
                        return response()->json(['status' => 0, 'message' => 'Deleted form but failed to delete form table']);
                }
            }
        }
        return response()->json(['status' => 0, 'message' => 'Failed to delete form']);
    }


    /** Submits form data
    *
    * @param $request
    *
    * @return redirect page
    */
    public function submitForm(Request $request)
    {
        $form_id = $request->input('form_id');
        if (!$form_id) {
            return "<h1>Oops! Something went wrong.</h1>Please contact SFDS to fix your form.";
        }
        $form = Form::where('id', $form_id)->first();
        $form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object

        if ($response = $this->dataStoreHelper->submitForm($form, $request)) {
            if (!empty($response) && $response['status'] == 0) {  //failed submissions
                return response()->json($response);
            } else {
                $submitted_data = array();
                if (isset($form['content']['settings']['confirmation']) && $form['content']['settings']['confirmation'] != "") {
                    return response()->json(['status' => 1, 'message' => 'Submitted data to the database', 'redirect_url' => $form['content']['settings']['confirmation'], 'submitted_data' => $submitted_data]);
                } else {
                    foreach ($_POST as $key => $value) {
                        $submitted_data[] = array($key => $value);
                    }
                    return view('layouts.submission', ['data' => $submitted_data]);
                }
            }
        }
    }

    /** Save partial form data
    *
    * @param $request
    *
    * @return redirect page
    */
    public function submitPartialForm(Request $request)
    {
        $form_id = $request->input('form_id');
        if (!$form_id) {
            return "<h1>Oops! Something went wrong.</h1>Please contact SFDS to fix your form.";
        }
        $form = Form::where('id', $form_id)->first();
        $form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
        //todo backend validation
        $referer = $request->headers->get('referer');
        $host = parse_url($referer, PHP_URL_HOST);
        $path = parse_url($referer, PHP_URL_PATH);
        $scheme = parse_url($referer, PHP_URL_SCHEME);
        $form['host'] = $host !== '' ? $scheme.'://'.$host.$path : '';
        if ($response = $this->dataStoreHelper->submitForm($form, $request, 'partial')) {
            $data = $response['data'];
            $this->emailController->sendEmail($data, 'emails.saveForLater');
            return view('emails.saveForLater', ['data' => $data['body']]);
        }
    }

    /** Import form definition from jekyll
    *
    * @param $request
    *
    * @return redirect page
    */
    public function jekyllImport(Request $request)
    {
        $file = $request->file('upload_file');
        $contents = file_get_contents($file->getRealPath());
        if($contents !== '' && $response = $this->dataStoreHelper->jekyllImport($contents)){
          //return view('editor',['user_id' => $login['id'], 'api_token' => $api_token, 'name' => $login['name']]);
          return view('login');
        }
    }

    /** Determine form has been published
    *
    * @param $request
    *
    * @return bool
    */
    public function CSVPublished(Request $request)
    {
        return 0;
        //return $this->dataStoreHelper->isCSVPublished($this->getFilename($request)) ? 1 : 0;
    }

    /** Purges submitted form data
     *
     * @param $request
     *
     * @return json response
     */
    public function purgeCSV(Request $request)
    {
        return true;
    }

  /** Gets S3 unique filename
    *
    * @param $request
    *
    * @return string
    */
  public function getFilename(Request $request)
  {
      $id = $request->input('id');
      //todo make sure user has access to this form id
      $path = $request->input('path');
      if ($path) {
          return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$this->controllerHelper->generateFilename($id);
      } else {
          return $this->controllerHelper->generateFilename($id);
      }
  }

    /** Gets submitted form data as CSV/Excel
    *
    * @param $request
    *
    * @return Response object
    */
    public function exportFormData(Request $request)
    {
        $id = $request->input('formid');
        if ($id) {
            $filename = 'form-' .$id .'_'. date('d-m-Y-H:i:s').'.csv';
            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            $data = $this->dataStoreHelper->getSubmittedFormData($id);
            if (sizeof($data) > 0) {
                // extract columns from $data
                $columns = array_keys((array)$data[0]);
                $callback = function () use ($data, $columns) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);

                    foreach ($data as $row) {
                        fputcsv($file, array_values((array)$row));
                    }
                    fclose($file);
                };
                return (new \Symfony\Component\HttpFoundation\StreamedResponse($callback, 200, $headers))->sendContent();
            }
        }
        return null;
    }

    /** Alert the logged in user if shared form has updated
    *
    * @param $request
    *
    * @return void
    */
    public function notifyUser(Request $request)
    {
        $form_id = $request->input('form_id');
        $started = false;
        $num = 0;

        header("Content-Type: text/event-stream");
        header("Cache-Control: no-store");
        header("Access-Control-Allow-Origin: *");

        while (1) {
            // 1 is always true, so repeat the while loop forever (aka event-loop)
            $num++;

            //todo make sure user has access to this form id
            $form = $this->getForm($request);
            if (!$form) {
                echo "Error, form does not exist.";
                return;
            }

            if (!$started) {
                $last_updated = $form->original['updated_at'];
                $started = true;
            } else {
                if ($form->original['updated_at'] > $last_updated) {
                    $formData = json_encode($form->original);
                    echo "data: {$formData}\n\n";
                    $last_updated = $form->original['updated_at'];
                }
            }

            // flush the output buffer and send echoed messages to the browser

            while (ob_get_level() > 0) {
                ob_end_flush();
            }
            flush();

            // break the loop if the client aborted the connection (closed the page)

            if (connection_aborted()) {
                break;
            }

            // sleep for 10 second before running the loop again

            sleep(10);
        }
    }

    /** Get a list of drafts
    *
    * @param $request
    *
    * @return Page
    */
    public function getFormDraftList(Request $request){
      $hash = $request->input('email');
      $data = array();
      if ($hash) {
          $list = $this->dataStoreHelper->getFormDraftList($hash);
          if ( (isset($list['status']) && $list['status'] == 0 ) || ! $list) {
              $template = 'emails.noDraftsFound';
          } else {
              $template = 'emails.confirmationDraftList';
              // send "resume draft" email
              $data['emailInfo']['address'] = $hash;
              $data['emailInfo']['subject'] = 'Here is your list of form drafts';
              $data['body']['list'] = $list;
              $emailTemplate = 'emails.draftList';
              $this->emailController->sendEmail($data, $emailTemplate);
          }
      }
      // return "no drafts found" page
      return view($template, ['data' => $data]);
    }

    /** Let user check form drafts based on input email
    *
    * @param $request
    *
    * @return Page
    */
    public function resumeDraft(Request $request){
        $template = 'emails.resumeDraft';
        $url = '//'.$request->getHttpHost(). '/form/draft-list';
        return view($template, ['host' => $url]);
    }
}