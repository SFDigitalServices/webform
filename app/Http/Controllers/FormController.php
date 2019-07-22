<?php
namespace App\Http\Controllers;

//putenv('HOME=/var/www/html');
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


use Illuminate\Http\Request;

class FormController extends Controller
{
    protected $controllerHelper;
    protected $dataStoreHelper;
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
            'purgeCSV'
          ]]);
        $this->controllerHelper = new ControllerHelper();
        $this->dataStoreHelper = new DataStoreHelper();
    }

    /**
     *  Provide API to obtain user api token.
     *  This is expected to change when SSO is available.
     */
    public static function getApiToken(Request $request)
    {
        return UserHelper::getApiToken($request->input('email'), $request->input('password'));
    }

    /**
    * Gets all the forms for the current logged in user.
    *
    * @return json object
    */
    public function getUserForms(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = Auth::user()->where('id', $user_id)->get();
        $user_forms = User_Form::where('user_id', $user_id)->get();

        $forms = array();
        foreach ($user_forms as $form_arr) {
            $form = Form::where('id', $form_arr['form_id'])->get()->first();
            $form['content'] = $this->controllerHelper->scrubString($form['content']);
            $form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
            array_push($forms, $form);
        }
        return response()->json($forms);
    }
    /**
    * Gets a form for the current logged in user.
    *
    * @return json object
    */
    public function getForm(Request $request)
    {
        $form_id = $request->input('form_id');
        $form = Form::where('id', $form_id)->first();
        $form['content'] = $this->controllerHelper->scrubString($form['content']);

        return $form ? response()->json($form) : response()->json(['status' => 'failed']);
    }

    /**
    * Saves the edited form for the current logged in user. Saves the form_table
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
            $previousContent['data'] = ($request->input('previousContent'));
            $this->processCSV($returnForm, $request->getHttpHost());

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
                $updated_table = DataStoreHelper::saveFormTableColumn('forms_'.$returnForm->id, $this->controllerHelper->getFormColumnsToUpdate($definitions, $previousContent));
                if (isset($updated_table['status']) && $updated_table['status'] == 0) {
                    return response()->json(['status' => 0, 'message' => 'Failed to update form table']);
                }
            //}
        }
        return response()->json($returnForm);
    }

    /**
    * Clone from an existing form. Clones the form_table too?
    *
    * @return json object
    */
    public function clone(Request $request)
    {
        $user_id = $request->input('user_id');
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();

        if ($form) {
            $content = json_decode($form['content'], true);
            //return $content->settings->name;
            //$content = $form->content;
            $content['settings']['name'] = "Clone of ".$content['settings']['name'];
            $cloned_form = Form::create(['content' => json_encode($content)]);

            if ($cloned_form) {
                // create entry in user_form
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $cloned_form->id]);
                if ($user_form) {
                    return response()->json(['status' => 1, 'data' => $user_form]);
                }
            }
            return response()->json(['status' => 0, 'message' => 'Failed to clone form']);
        }
        return response()->json(['status' => 0, 'message' => 'Form doesn\'t exist']);
    }

    /**
    * Share an existing form with another user.
    *
    * @return json object
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

    /**
    * Provides a list of users attached to a form.
    *
    * @return a comma separated string of emails
    */
    public function getAuthors(Request $request)
    {
        $form_id = $request->input('id');
        return response()->json(['status' => 1, 'data' => UserHelper::formatAuthors(UserHelper::getFormUsers($form_id))]);
    }

    /**
    * Creates a new form for the current logged in user. Creates the form_table
    *
    * @return json object
    */
    public function create(Request $request)
    {
        // validate form data
        if ($this->validateForm($request)) {
            $form = Form::create(['content' => $this->controllerHelper->scrubString($request->input('content'))]);
            if ($form) {
                $this->processCSV($form, $request->getHttpHost());
                // create entry in user_form
                $user_id = $request->input('user_id');
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $form->id]);
                if ($user_form) {
                    $returnForm = Form::where('id', $form->id)->first();
                    $returnForm['content'] = json_decode($returnForm['content'], true);
                    // create the form table
                    //if (isset($returnForm['content']['settings']['backend']) && $returnForm['content']['settings']['backend'] == "csv") {
                        $created_table = DataStoreHelper::createFormTable('forms_'.$form->id, $returnForm['content']['data']);
                        if ($created_table) {
                            return response()->json($returnForm);
                        } else {
                            return response()->json(['status' => 0, 'message' => 'Created form but failed to create form table']);
                        }
                    //}
                    //return response()->json($returnForm);
                }
            }
            return response()->json(['status' => 0, 'message' => 'Failed to create form']);
        }
    }

    /**
    * Creates a page preview of the form
    *
    * @return HTML
    */
    public function preview(Request $request)
    {
        $form_id = $request->input('id');

        $embedHTML = $this->embedJS($request);
        return '<!DOCTYPE html><html><head><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>'.
        '<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.1/validator.min.js"></script>'.
        '<script src="https://formbuilder-sf-staging.herokuapp.com/assets/js/error-msgs.js"></script>'.
        '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />'.
        '<link rel="stylesheet" href="https://formbuilder-sf-staging.herokuapp.com/assets/css/form-base.css" />'.
        '<style>#SFDSWF-Container {padding:2em 5em}#SFDSWFB-legend {position:relative !important;height:auto;width:auto;font-size:3em}</style></head>'.
        '<body><div id="SFDSWF-Container"></div><script>'.$embedHTML.'</script><noscript>This form requires JavaScript. Please reload the page, or enable JavaScript in your browser.</noscript></body></html>';
    }

    /**
    * Creates a page preview of the submitted form
    *
    * @return HTML
    */
    public function previewSubmitted(Request $request)
    {
		print "<div style='padding:3em 4.5em'>";
			print "<h2>Please set a Form Action before trying to embed your form.</h2>";
			print "<h3>Below is a summary of what you just submitted:</h3>";
			foreach ($_POST as $key => $value) {
				print $key . " = " . $value . "<br/>";
			}
		print "</div>";
    }

    /**
    * Creates an embed JS for the form
    *
    * @return HTML
    */
    public function embedJS(Request $request)
    {
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
				$form['content'] = $this->controllerHelper->scrubString($form['content']);
        $form['content'] = json_decode($form['content'], true);
        return $this->wrapJS($form, $request->getSchemeAndHttpHost());
    }

    /**
    * Generates HTML from the form
    *
    * @return HTML
    */
    public function generate(Request $request)
    {
        $form_id = $request->input('id');
				$form = Form::where('id', $form_id)->first();
				$form['content'] = $this->controllerHelper->scrubString($form['content']);
				$form['content'] = json_decode($form['content'], true);
        return $this->getHTML($form, $request->getSchemeAndHttpHost());
    }

    /**
    * Deletes a form, removes the form_table
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
                    $deleted = DataStoreHelper::deleteFormTable($form_id);
                    if( $deleted )
                        return response()->json(['status' => 1, 'message' => 'Deleted form from user']);
                    else
                        return response()->json(['status' => 0, 'message' => 'Deleted form but failed to delete form table']);
                }
            }
        }
        return response()->json(['status' => 0, 'message' => 'Failed to delete form']);
    }

    /**
    * Submits form data
    *
    * @return redirect page
    */
    public function submitCSV(Request $request){
      //Log:info($request->input('form_id'));
      $form_id = $request->input('form_id');
      if (!$form_id) {
          return "<h1>Oops! Something went wrong.</h1>Please contact SFDS to fix your form.";
      }
      $form = Form::where('id', $form_id)->first();
      $form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
      //todo backend validation

      if($this->dataStoreHelper->submitCSV($form,$request)){
          return redirect($form['content']['settings']['confirmation']);
      }
    }
    // EMBED FUNCTIONS
    public function getHTML($form, $base_url = ''){
        $content = $form['content'];
        // form setting (json)
        $formEncoding = $this->controllerHelper->hasFileUpload($content['data']) ? ' enctype="multipart/form-data"' : '';

        $form_div = '<form class="form-horizontal" action="'.$content['settings']['action'].'" method="'.$content['settings']['method'].'" '.$formEncoding.'><fieldset><div id="SFDSWFB-legend"><legend>'.$content['settings']['name'].'</legend></div>';

        $form_container = '';
        $sections = [];
        //if this form is a csv transaction, add form_id.
        if( isset($content['settings']['backend']) ) {
            $form_container .= '<input type="hidden" name="form_id" value="'.$form['id'].'"/>';
        }

        // looping through all form fields.
        foreach ($content['data'] as $field) {
            $field_header = '<div class="form-group" data-id="'.$field['id'].'">' . HTMLHelper::fieldLabel($field);

            switch ($field['formtype']) {
												case "s08": $form_container .= $field_header . HTMLHelper::formRadio($field). HTMLHelper::helpBlock($field);
														break;
                        case "s06": $form_container .= $field_header . HTMLHelper::formCheckbox($field) . HTMLHelper::helpBlock($field);
                            break;
                        case "i14": $form_container .= $field_header . HTMLHelper::formTextArea($field) . HTMLHelper::helpBlock($field);
                            break;
                        case "s02":
                        case "s04":
                        case "s14":
                        case "s15":
                        case "s16":
                            $form_container .= $field_header . HTMLHelper::formSelect($field) . HTMLHelper::helpBlock($field);
                            break;
                        case "m02":
                        case "m04":
                        case "m06": $form_container .= $field_header . HTMLHelper::formHtag($field) . HTMLHelper::helpBlock($field);
                            break;
                        case "m08":
                        case "m10":
                            $form_container .= $field_header . HTMLHelper::formParagraph($field) .HTMLHelper::helpBlock($field);
                            break;
						case "m13":
							$form_container .= '<div class="form-group" data-id="'.$field['id'].'">' . HTMLHelper::formFile($field) . HTMLHelper::helpBlock($field);
							break;
                        case "m14":
							if (empty($sections)) $form_container .= $field_header . HTMLHelper::formButton($field) . HTMLHelper::helpBlock($field);
                            break;
                        case "m16": $form_container .= HTMLHelper::formSection($field); $sections[] = $field;
                            break;
                        case "m11": $form_container .= HTMLHelper::formHidden($field);
                            break;
                        default: $form_container .= $field_header . HTMLHelper::formText($field) . HTMLHelper::helpBlock($field);
                            break;
              }
            // append help block
            //$form_container .= HTMLHelper::helpBlock($field);
        } //end of foreach


        // Form Sections
        if (!empty($sections)) {
            $section1 = isset($content['settings']['section1']) ? $content['settings']['section1'] : $content['settings']['name'];
            $nav = '<ul class="form-section-nav"><li class="active">'.$section1.'</li>';
            foreach ($sections as $idx => $section) {
                $active = $idx === "0" ? ' class="active"' : '';
                $nav .= '<li'.$active.'>'.$section['label'].'</li>';
            }
            $nav .= '</ul>';
            $form_wraper_top = '<div class="sections-container"><div class="form-section-header active">'.$section1.'</div><div class="form-section active">';
            $form_wrapper_bottom = '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><button id="submit" class="btn btn-lg submit">Submit</button></div></div></div>';
            $form_container = $nav. $form_div. $form_wraper_top. $form_container. $form_wrapper_bottom;
        } else {
            $form_container = $form_div. $form_container;
        }

        $form_end = '</fieldset></form>';
        // clean up line breaks, otherwise embedjs will fail
        return preg_replace("/\r|\n/", "", $form_container . $form_end);
    }

    public function isSectional($content){
        foreach ($content['data'] as $field) {
            if ($field['formtype'] == "m16") {
                return true;
            }
        }
        return false;
    }

    public function getInputSelector($id, $arr, $checked){
        $output = "";
        if (!$id) {
            return $output;
        }
        switch ($arr[$id]) {
            case "s06":
                if ($checked) {
                    $output = 'input[name="'.$id.'[]"]:checked';
                } else {
                    $output = 'input[name="'.$id.'[]"]';
                }
                break;
            case "s08":
                if ($checked) {
                    $output = "input[name=".$id."]:checked";
                } else {
                    $output = "input[name=".$id."]";
                }
                break;
            default:
                $output = "#".$id;
        }
        return $output;
    }

    public function getConditionalStatement($value1, $op, $value2){
        if (!$op) {
            return "";
        }
        if ($op == "contains") {
            $output = "(".$value1.").search(/".$value2."/i) != -1";
        } elseif ($op == "doesn't contain") {
            $output = "(".$value1.").search(/".$value2."/i) == -1";
        } else {
            $output = $value1." ".$op." '".$value2."'";
        }
        return $output;
    }

    public function wrapJS($form, $base_url = '')
    {
        $str = $this->getHTML($form, $base_url);
        $sectional = $this->isSectional($form['content']);

        $js = "var script = document.createElement('script');script.onload = function () {"; //start ready

        $js .= "document.getElementById('SFDSWF-Container').innerHTML = '".$str."';";
        $js .= "if (typeof SFDSerrorMsgs != 'undefined') { SFDSerrorMsgs(); } else { jQuery('#SFDSWF-Container form').validator(); }";

        //check content for extra features
        $calculations = [];
        $conditions = [];
        $webhooks = [];
        $formtypes = [];
        if ($form['content']) {
            foreach ($form['content']['data'] as $field) {
                $fieldId = $field['id'];
                $formtypes[$fieldId] = $field['formtype'];
                foreach ($field as $key => $value) {
                    if ($key == "calculations") { //gather calculations
                        $calculations[$fieldId] = $value;
                    } elseif ($key == "conditions") { //gather conditionals
                        $conditions[$fieldId] = $value;
                    } elseif ($key == "webhooks") {
                        $webhooks[$fieldId] = $value;
                    }
                }
            }
        }

        if (!empty($calculations)) { //add calculational behavior
            $calculationIds = [];
            $calculationOps = [];
            foreach ($calculations as $id => $arr) {
                $calculationIds[$id] = [];
                $calculationOps[$id] = [];
                foreach ($arr as $i => $val) {
                    if ($i % 2 == 0) {
                        $calculationIds[$id][] = $val;
                    } else {
                        $val2 = "";
                        if ($val == "Plus") {
                            $val2 = "+";
                        } elseif ($val == "Minus") {
                            $val2 = "-";
                        } elseif ($val == "Multiplied by") {
                            $val2 = "*";
                        } elseif ($val == "Divided by") {
                            $val2 = "/";
                        }
                        $calculationOps[$id][] = $val2;
                    }
                }
                $count = 0;
                $js .= "jQuery('";
                while ($count < count($calculationIds[$id])) {
                    $js .= $this->getInputSelector($calculationIds[$id][$count], $formtypes, false).", ";
                    $count++;
                }
                $js = substr($js, 0, -2)."').on('keyup change',function(){";

                $calcFunc = "jQuery('".$this->getInputSelector($id, $formtypes, false)."').val(";

                $count = 0;
                while ($count < count($calculationIds[$id])) {
                    $calcFunc .= "parseFloat(jQuery('".$this->getInputSelector($calculationIds[$id][$count], $formtypes, true)."').val())";
                    if (isset($calculationOps[$id][$count])) {
                        $calcFunc .= " ".$calculationOps[$id][$count]." ";
                    }
                    $count++;
                }
                $calcFunc .= 	")";
                $js .= $calcFunc;
                $js .= "});";
                $js .= $calcFunc;
            }
        }

        if (!empty($conditions)) { //add conditional behavior
            foreach ($conditions as $id => $fld) {
                //set default visibility
                $js .= "jQuery('".$this->getInputSelector($id, $formtypes, false)."').closest('.form-group')";
                if ($fld['showHide'] == "Show") {
                    $js .= ".hide();";
                    $revert = "hide";
                } elseif ($fld['showHide'] == "Hide") {
                    $js .= ".show();";
                    $revert = "show";
                }
                $conditionIds = [];
                $conditionSts = [];
                //loop through each condition
                foreach ($fld['condition'] as $index => $condition) {
                    if (!in_array($condition['id'], $conditionIds)) {
                        $conditionIds[] = $condition['id'];
                    }
                    $conditionSts[] = $this->getConditionalStatement("jQuery('".$this->getInputSelector($condition['id'], $formtypes, true)."').val()", $this->controllerHelper->getOp($condition['op']), $condition['val']);
                }
                if ($fld['allAny']) {
                    //group multiple conditions
                    $allConditionSts = implode(" ".$this->controllerHelper->getOp($fld['allAny'])." ", $conditionSts);
                } else {
                    //or just assign single statement
                    $allConditionSts = $conditionSts[0];
                }
                //set up listeners and populate conditional statements
                $js .= "jQuery('";
                foreach ($conditionIds as $chId) {
                    $js .= $this->getInputSelector($chId, $formtypes, false).", ";
                }
                $js = substr($js, 0, -2)."').on('keyup change',function(){";
                $js .= "if (".$allConditionSts.") {jQuery('".$this->getInputSelector($id, $formtypes, false)."').closest('.form-group').".strtolower($fld['showHide'])."()} else {jQuery('".$this->getInputSelector($id, $formtypes, false)."').closest('.form-group').".$revert."()}});";
            }
        }

        if ($sectional) { //additional controls for sectional forms
            $js .= "initSectional();";
        }
        if (!empty($webhooks)) { //add webhooks behavior
            foreach ($webhooks as $id => $fld) {
                $webhookIds = [];
                //loop through ids
                foreach ($fld['ids'] as $index => $fieldId) {
                    if (!in_array($fieldId, $webhookIds)) {
                        $webhookIds[] = $fieldId;
                    }
                }
                //bind ids with onchange listeners to call webhook
                $js .= "jQuery('";
                foreach ($webhookIds as $whId) {
                    $js .= $this->getInputSelector($whId, $formtypes, false).", ";
                }
                $js = substr($js, 0, -2)."').on('change',function(){";
                //make function check all ids that need to post values have a value
                $js .= "if (";
                foreach ($webhookIds as $whId) {
                    $js .= "jQuery('" . $this->getInputSelector($whId, $formtypes, false) . "').val() != '' && ";
                }
                $delimiter = "";
                $responseOptionsIndex = "";
                if ($fld['optionsArray']) {
                    $delimiter = ", " . ($fld['delimiter'] != "" ? "'" . $fld['delimiter'] . "'" : "null");
                    $responseOptionsIndex = ", " . ($fld['responseOptionsIndex'] != "" ? "'" . $fld['responseOptionsIndex'] . "'" : "null");
                }
                $js = substr($js, 0, -4) . 	") ";
                $js .= "callWebhook('" . $id . "', '" . $fld['endpoint'] . "', Array('" . implode(",", $webhookIds) . "'), '" . $fld['responseIndex'] . "', '" . $fld['method'] . "', " . $fld['optionsArray'] . $delimiter . $responseOptionsIndex . ");";
                $js .= '});';
            }
        }
        $js .= "};script.src = '".$base_url."/assets/js/embed.js';document.head.appendChild(script);"; //end ready
        return $js;
    }

    /**
    * validates form data
    *
    * @return json object
    */
    protected function validateForm(Request $request)
    {
        return response()->json(['status' => 0, 'message' => 'Failed to delete form']);
    }

    public function purgeCSV(Request $request)
    {
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
        $content = json_decode($form->content);
        $filename = $this->controllerHelper->generateFilename($form_id);
        $this->dataStoreHelper->rewriteCSV($content, $filename);
        return response()->json(['status' => 1, 'message' => 'Purged CSV']);
    }

    public function processCSV($form, $base_url = '')
    {
        //read content and settings
        $content = json_decode($form->content);
        if( isset($content->settings->backend) && $content->settings->backend == "csv"){
            $filename = $this->controllerHelper->generateFilename($form->id);
            //rewrite header row if CSV is not published (only header row or less exists)
            if (!$this->dataStoreHelper->isCSVPublished($filename)) {
                $this->dataStoreHelper->rewriteCSV($content, $filename);
            }
        }
    }

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

    public function CSVPublished(Request $request)
    {
        return $this->dataStoreHelper->isCSVPublished($this->getFilename($request)) ? 1 : 0;
    }

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
}
