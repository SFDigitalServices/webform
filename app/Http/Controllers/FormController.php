<?php
namespace App\Http\Controllers;

//putenv('HOME=/var/www/html');
use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;

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
            $form['content'] = $this->scrubString($form['content']);
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
        $form['content'] = $this->scrubString($form['content']);

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
            $returnForm['content'] = $this->scrubString($request->input('content'));
            $previousContent = array();
            $previousContent['data'] = ($request->input('previousContent'));
            $this->processCSV($returnForm, $request->getHttpHost());

            $returnForm->save();
            //update form table
            $definitions = json_decode($returnForm['content'], true);
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
            return response()->json($returnForm);
        }
        //return response()->json(['status' => 0, 'message' => 'Failed to save form']);
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
            $form = Form::create(['content' => $this->scrubString($request->input('content'))]);
            if ($form) {
                $this->processCSV($form, $request->getHttpHost());
                // create entry in user_form
                $user_id = $request->input('user_id');
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $form->id]);
                if ($user_form) {
                    $returnForm = Form::where('id', $form->id)->first();
                    $returnForm['content'] = json_decode($returnForm['content'], true);
                    // create the form table
                    $created_table = DataStoreHelper::createFormTable('forms_'.$form->id, $returnForm['content']['data']);
                    if ($created_table) {
                        return response()->json($returnForm);
                    } else {
                        return response()->json(['status' => 0, 'message' => 'Created form but failed to create form table']);
                    }
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
    * Creates an embed JS for the form
    *
    * @return HTML
    */
    public function embedJS(Request $request)
    {
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
				$form['content'] = $this->scrubString($form['content']);
        $form['content'] = json_decode($form['content'], true);
        return $this->wrapJS($form, $request->getHttpHost());
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
				$form['content'] = $this->scrubString($form['content']);
				$form['content'] = json_decode($form['content'], true);
        return $this->getHTML($form, $request->getHttpHost());
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
                    $deleted = DataStoreHelper::deleteFormTable('forms_'.$form_id);
                    if( $deleted )
                        return response()->json(['status' => 1, 'message' => 'Deleted form from user']);
                    else
                        return response()->json(['status' => 0, 'message' => 'Deleted form but failed to delete form table']);
                }
            }
        }
        return response()->json(['status' => 0, 'message' => 'Failed to delete form']);
    }

    function hasFileUpload($data) {
        foreach ($data as $field) {
            if ($field['formtype'] == "m13") {
                return true;
            }
        }
        return false;
    }

    // EMBED FUNCTIONS
    public function getHTML($form, $base_url = '')
    {
        $content = $form['content'];
        // form setting (json)
        $formEncoding = $this->hasFileUpload($content['data']) ? ' enctype="multipart/form-data"' : '';

        $form_div = '<form class="form-horizontal" action="'.$content['settings']['action'].'" method="'.$content['settings']['method'].'" '.$formEncoding.'><fieldset><div id="SFDSWFB-legend"><legend>'.$content['settings']['name'].'</legend></div>';

        $form_container = '';
        $sections = [];

        //if this form is a csv transaction, add form_id.
        $csvPath = '//'.$base_url.'/form/submit';
        if (substr($content['settings']['action'], 0 - strlen($csvPath)) == $csvPath) {
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
							$form_container .= $field_header . HTMLHelper::formFile($field) . HTMLHelper::helpBlock($field);
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

    public function isSectional($content)
    {
        foreach ($content['data'] as $field) {
            if ($field['formtype'] == "m16") {
                return true;
            }
        }
        return false;
    }

    public function getInputSelector($id, $arr, $checked)
    {
        $output = "";
		if (!$id) return $output;
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

    public function getConditionalStatement($value1, $op, $value2)
    {
		if (!$op) return "";
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
                    $conditionSts[] = $this->getConditionalStatement("jQuery('".$this->getInputSelector($condition['id'], $formtypes, true)."').val()", $this->getOp($condition['op']), $condition['val']);
                }
                if ($fld['allAny']) {
                    //group multiple conditions
                    $allConditionSts = implode(" ".$this->getOp($fld['allAny'])." ", $conditionSts);
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
					$js .= "callWebhook('" . $id . "', '" . $fld['endpoint'] . "', Array('" . implode(",",$webhookIds) . "'), '" . $fld['responseIndex'] . "', '" . $fld['method'] . "', " . $fld['optionsArray'] . $delimiter . $responseOptionsIndex . ");";
				$js .= '});';
				
            }
        }
		
		$js .= "};script.src = '/assets/js/embed.js';document.head.appendChild(script);"; //end ready
		
        return $js;
    }
	
    public function getOp($str)
    {
        $output = "";
        switch ($str) {
            case "Any":
                $output = "||";
                break;
            case "All":
                $output = "&&";
                break;
            case "matches":
                $output = "==";
                break;
            case "doesn't match":
                $output = "!=";
                break;
            case "is less than":
                $output = "<";
                break;
            case "is more than":
                $output = ">";
                break;
            case "contains anything":
                $output = "!=";
                break;
            case "is blank":
                $output = "==";
                break;
            case "contains":
                $output = "contains";
                break;
            case "doesn't contain":
                $output = "doesn't contain";
                break;
        }
        return $output;
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

    public function rewriteCSV($content, $filename)
    {
        $column = 0;
        $write = array();
        foreach ($content->data as $field) {
            $nonInputs = array("m02", "m04", "m06", "m08", "m10", "m13", "m14", "m16");
            $multipleInputs = array("s02", "s04", "s06", "s08");
            if (in_array($field->formtype, $multipleInputs)) {
                if ($field->formtype == "s02" || $field->formtype == "s04") {
										//$options = explode("\n", $field->option);
										$options = $field->option;
                } elseif ($field->formtype == "s06") {
                    $options = $field->checkboxes;
                } elseif ($field->formtype == "s08") {
                    $options = $field->radios;
                }
                foreach ($options as $option) {
                    $write[$column] = isset($field->name) ? $field->name." ".$option : $option;
                    $column++;
                }
            } elseif (!in_array($field->formtype, $nonInputs)) { // catch all for everything except multiple and non-inputs
                $write[$column] = isset($field->name) ? $field->name : '';
                $column++;
            }
        }
        //file_put_contents('/var/www/html/public/csv/'.$filename, implode(",",$write)."\n");
        $this->writeCSV($filename, implode(",", $write)."\n");
    }

    public function purgeCSV(Request $request)
    {
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
        $content = json_decode($form->content);
        $filename = $this->generateFilename($form_id);
        $this->rewriteCSV($content, $filename);
        return response()->json(['status' => 1, 'message' => 'Purged CSV']);
    }

    public function processCSV($form, $base_url = '')
    {
        //read content and settings
        $content = json_decode($form->content);
        if( isset($content->settings->backend) && $content->settings->backend == "csv"){
            $filename = $this->generateFilename($form->id);
            //rewrite header row if CSV is not published (only header row or less exists)
            if (!$this->isCSVPublished($filename)) {
                $this->rewriteCSV($content, $filename);
            }
        }
    }

    public function isCSVDatabase($formAction, $base_url = '')
    {
        $path = '//'. $base_url.'/form/submit';
        //if form action matches a csv transaction
        return substr($formAction, 0 - strlen($path)) == $path ? true : false;
    }

    /**
    *   Called from fb.js
    */
    public function CSVPublished(Request $request)
    {
        return $this->isCSVPublished($this->getFilename($request)) ? 1 : 0;
    }

    public function isCSVPublished($filename)
    {
        $csv = $this->readCSV($filename);
        return count($csv) > 1 ? true : false;
    }

    public function readCSV($filename)
    {
        //$csv = array_map('str_getcsv', file('/var/www/html/public/csv/'.$filename , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
        $csv = array();
        $read = $this->readS3($filename);
        if ($read) {
            $rows = str_getcsv($read, "\n");
            foreach ($rows as $row) {
                $csv[] = str_getcsv($row);
            }
        }
        return $csv;
    }

    public function writeCSV($filename, $body)
    {
        //file_put_contents('/var/www/html/public/csv/'.$filename, implode(",",$write)."\n");
        return $this->writeS3($filename, $body);
    }

    public function appendCSV($filename, $arr)
    {
        $csv = $this->readCSV($filename);
        array_push($csv, $arr);
        $output = "";
        foreach ($csv as $row) {
            $output .= implode(",", $row)."\n";
        }
        $this->writeCSV($filename, $output);
    }

    public function submitCSV(Request $request)
    {
        $form_id = $request->input('form_id');
        if (!$form_id) {
            return "<h1>Oops! Something went wrong.</h1>Please contact SFDS to fix your form.";
        }
        $form = Form::where('id', $form_id)->first();
        $form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
        //todo backend validation
        $column = 0;
        $write = array();

       foreach ($form['content']['data'] as $field) {
            if ($field['formtype'] == "m02" || $field['formtype'] == "m04" || $field['formtype'] == "m06" || $field['formtype'] == "m08" || $field['formtype'] == "m10" || $field['formtype'] == "m14" || $field['formtype'] == "m16") { //do nothing for non inputs
            } elseif ($field['formtype'] == "s02" || $field['formtype'] == "s04" || $field['formtype'] == "s06" || $field['formtype'] == "s08") { //multiple options
                if ($field['formtype'] == "s02" || $field['formtype'] == "s04") {
                    $options = $field['option'];
                } elseif ($field['formtype'] == "s06") {
                    $options = $field['checkboxes'];
                } elseif ($field['formtype'] == "s08") {
                    $options = $field['radios'];
                }
                foreach ($options as $option) {
                    if (is_array($request->input($field['name']))) {
                        $write[$column] = in_array($option, $request->input($field['name'])) ? 1 : 0;
                    } else {
                        $write[$column] = $request->input($field['name']) == $option ? 1 : 0;
                    }
                    $column++;
                }
            } else if ($field['formtype'] == "m13" && isset($field['name'])) { //for file uploads, checks if field has a name
					if ($request->file($field['name']) != null && $request->file($field['name'])->isValid()) { //checks if field is populated with an acceptable value
						$file = $request->file($field['name']);
						$newFilename = $this->generateUploadedFilename($form_id, $field['name'], $file->getClientOriginalName());
						$this->writeS3($newFilename, file_get_contents($file));
						$write[$column] = $this->getBucketPath().$newFilename;
					}
                    $column++;
            } else {
                // fixed bug: if 'name' attribute was not set, exception is thrown here.
                if( isset( $field['name']) )
                    $write[$column] = $request->input($field['name']);
                //$write[$column] = $field['name']; //todo write first row
                $column++;
            }
        }

        $this->appendCSV($this->generateFilename($form_id), $write);

        return redirect($form['content']['settings']['confirmation']);
    }

    public function writeS3($filename, $body)
    {
        $s3 = new S3Client([
            'region'      => env('BUCKETEER_AWS_REGION'),
            'version'     => 'latest',
            'credentials' => CredentialProvider::env()
    ]);

        $result = $s3->putObject([
            'Bucket' => env('BUCKETEER_BUCKET_NAME'),
            'Key' => 'public/'.$filename,
            'Body' => $body,
        ]);

        return $result;
    }

    public function readS3($filename)
    {
        $s3 = new S3Client([
            'region'      => env('BUCKETEER_AWS_REGION'),
            'version'     => 'latest',
            'credentials' => CredentialProvider::env()
    ]);

        if ($s3->doesObjectExist(env('BUCKETEER_BUCKET_NAME'), 'public/'.$filename)) {
            $result = $s3->getObject([
                'Bucket' => env('BUCKETEER_BUCKET_NAME'),
                'Key' => 'public/'.$filename
            ]);
            return $result['Body'];
        } else {
            return false;
        }
    }

    public function getFilename(Request $request)
    {
        $id = $request->input('id');
        //todo make sure user has access to this form id
        $path = $request->input('path');
        if ($path) {
            return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$this->generateFilename($id);
        } else {
            return $this->generateFilename($id);
        }
    }

    public function getBucketPath() {
        return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/';
    }

    private function generateFilename($id)
    {
        $hash = substr(sha1($id.env('FILE_SALT')), 0, 8);
        return $id.'-'.$hash.'.csv';
    }

    private function generateUploadedFilename($formId, $name, $filename) { //todo use responseId instead of time
        $time = time();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $hash = substr(sha1($formId.$time.env('FILE_SALT')),0,8);
        //return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
        return $formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
    }

    private function scrubString($str)
    {
        if (empty($str)) {
            return $str;
        }

        $scrubbed = htmlspecialchars($str, ENT_NOQUOTES);
        $scrubbed = str_replace("'", "&apos;", $scrubbed);
        $scrubbed = str_replace('\"', "", $scrubbed);
		$scrubbed = json_encode($this->controllerHelper->parseOptionValues(json_decode($scrubbed, true)));
        return $scrubbed;
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
