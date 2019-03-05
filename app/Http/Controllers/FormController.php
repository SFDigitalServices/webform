<?php
namespace App\Http\Controllers;

//putenv('HOME=/var/www/html');
use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;

use App\Form;
use Auth;
use App\User;
use App\User_Form;
use Validator;
use App\Helpers\UserHelper;
use App\Helpers\ListHelper;

use Illuminate\Http\Request;
class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // defines operations that need to be protected
        $this->middleware('auth', ['only' => 
            ['create',
            'save',
            'clone',
            'getUserForms',
            'getForm',
						'getFilename',
						'share',
						'getAuthors',
						'purgeCSV'
            ]]);
    }

		/**
		 *  Provide API to obtain user api token.
		 *  This is expected to change when SSO is available.
		 */
		public function getApiToken(Request $request){
			return UserHelper::getApiToken($request->input('email'), $request->input('password'));
		}

     /**
     * Gets all the forms for the current logged in user.
     *
     * @return json object
     */
    public function getUserForms(Request $request){
        $user_id = $request->input('user_id');
        $user = Auth::user()->where('id', $user_id)->get();

        $user_forms = User_Form::where('user_id', $user_id)->get();
       
        $forms = array();
        foreach($user_forms as $form_arr){
						$form = Form::where('id', $form_arr['form_id'])->get()->first();
						$form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
            array_push($forms, $form);
        }
        return response()->json($forms);
        //return view('editor', ['name' => $user->name, 'forms' => $user_forms]);
    }
     /**
     * Gets a form for the current logged in user.
     *
     * @return json object
     */
    public function getForm(Request $request){
        $form_id = $request->input('form_id');
        $form = Form::where('id', $form_id)->first();
        
        return $form ? response()->json($form) : response()->json(['status' => 'failed']);
    }

     /**
     * Saves the edited form for the current logged in user.
     *
     * @return bool 
     */
    public function save(Request $request){
		//todo I think this is needed for html
		/*
		$form_data = [];
		$form_data['content'] = $request->input('content');

        $form_data['content'] = str_replace('\"','\\\\\"', $form_data['content']);
        $form_data['content'] = str_replace("'","&apos;", $form_data['content']);
        $form_data['content'] = str_replace("<","&lt;",$form_data['content']);
        $form_data['content'] = str_replace(">","&gt;",$form_data['content']);
        $form_data['content'] = json_decode($form_data['content']);
		*/

        $form_id = $request->input('id');
       
        if($form_id == 0)
        {
            return $this->create($request);
        } else {
			$returnForm = Form::where('id', $form_id)->first();
			//$returnForm['content'] = $form_data['content'];
			$this->processCSV($returnForm, $request->getHttpHost());
			$returnForm['content'] = $this->scrubString($request->input('content'));
			$returnForm->save();
			return response()->json($returnForm);
		}
        return response()->json(['status' => 0, 'message' => 'Failed to save form']); 
    }

     /**
     * Clone from an existing form.
     *
     * @return json object
     */
    public function clone(Request $request){
        $user_id = $request->input('user_id');
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
        
        if($form){
            $content = json_decode($form['content'], true);
            //return $content->settings->name;
			//$content = $form->content;
            $content['settings']['name'] = "Clone of ".$content['settings']['name'];
            $cloned_form = Form::create(['content' => json_encode($content)] );

            if( $cloned_form ){
                // create entry in user_form
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $cloned_form->id]);
                if($user_form){
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
    public function share(Request $request){

		$this->validate($request, [
			'id' => 'required',
			'email' => 'required|email'
		]);
	
		$email = $request->input('email');
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
		
        if(!$form){
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
	public function getAuthors(Request $request) {
        $form_id = $request->input('id');
		return response()->json(['status' => 1, 'data' => UserHelper::formatAuthors(UserHelper::getFormUsers($form_id))]);  
	}
		
     /**
     * Creates a new form for the current logged in user.
     *
     * @return json object
     */
    public function create(Request $request) {
        // validate form data
        if( $this->validateForm($request) ) {

			/*generate a hash based on id
			$form = Form::create(['content' => $request->input('content')]);
			$hash = sha1($form['id']."#lfk&$#3mXqVekHQjpaqW");
			$content = json_decode($form['content']);
			$content->settings->hash = $hash;
			$form['content'] = json_encode($content);
			$form->save();
			*/
			
			$form = Form::create(['content' => $this->scrubString($request->input('content'))]);
			
            if( $form ){
				$this->processCSV($form, $request->getHttpHost());
                // create entry in user_form
                $user_id = $request->input('user_id');
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $form->id]);
                if($user_form){
                    //return response()->json(['status' => 1, 'data' => $user_form]);  
					$returnForm = Form::where('id', $form->id)->first();
					$returnForm['content'] = json_decode($returnForm['content'], true);
					return response()->json($returnForm);
                }
            }
            return response()->json(['status' => 0, 'message' => 'Failed to create form']);  
        }      
    }

     /**
     * Creates an embed JS for the form
     *
     * @return HTML
     */
    public function embedJS(Request $request){
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
		//$form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
		$sections = array();

		$form['content'] = json_decode($form['content'], true);

		return $this->wrapJS($this->generateHTML($form, $request->getHttpHost()),$this->isSectional($form['content']), $form['content']);
   }

     /**
     * Generates HTML from the form
     *
     * @return HTML
     */
    public function generate(Request $request){
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
		//$form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
		$sections = array();

		$form['content'] = json_decode($form['content'], true);

		return $this->generateHTML($form, $request->getHttpHost());
   }
   
     /**
     * Deletes a form
     *
     * @return json object
     */
    public function delete(Request $request) {
        $user_id = $request->input('user_id');
        $form_id = $request->input('id');

        // soft delete?
		// check permission
        $user_form_delete = User_Form::where([['user_id','=', $user_id], ['form_id', '=', $form_id]])->delete();
        if( $user_form_delete ){ //check if no more users own that form, then delete
			$remaining_form_users = User_Form::where('form_id', $form_id)->first();
			if (!$remaining_form_users) {
				$form_delete = Form::where([['id', $form_id]])->delete();
				if( $form_delete ){
					 return response()->json(['status' => 1, 'message' => 'Deleted form from user']); 
				}
			}
        }
       return response()->json(['status' => 0, 'message' => 'Failed to delete form']);      
    }
	
	// EMBED FUNCTIONS
	public function generateHTML($form, $base_url = '') {
		$content = $form['content'];

		$str1 = '<form class="form-horizontal" action="'.$content['settings']['action'].'" method="'.$content['settings']['method'].'"><fieldset><div id="SFDSWFB-legend"><legend>'.$content['settings']['name'].'</legend></div>';
		$str = '';
	
		$csvPath = '//'.$base_url.'/form/submit';

		//if this form is a csv transaction, add form_id
		if (substr($content['settings']['action'],0 - strlen($csvPath)) == $csvPath) $str .= '<input type="hidden" name="form_id" value="'.$form['id'].'"/>';

		foreach ($content['data'] as $field) {
		  if ($field['formtype'] == "m16") { //special parsing for form sections
			  $sections[] = $field;
			  $str .= '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id="'.$field['id'].'">'.$field['label'].'</div><div class="form-section" data-id="'.$field['id'].'">';
		  } else if ($field['formtype'] == "m11") { //hidden fields
			  $str .= '<input type="hidden" name="'.$field['name'].'" id="'.$field['id'].'" value="'.$field['value'].'"/>';
		  } else {
			  $str .= '<div class="form-group" data-id="'.$field['id'].'"><label class="control-label">';
			  $str .= isset($field['label']) ? $field['label'] : "";
			  $str .= ' <span class="optional">(optional)</span></label><div>';
			  $str .= $this->printFormTypeStart($field['formtype']);
			  $skipAttr = false;
			  $isCheckbox = false;
			  $attr = "";
			  $inner = "";
			  $help = "";
			  foreach ($field as $key => $value) {
				if ($key == "option") {
				  $inner .= '>';
				  $options = explode("\n",$value);
				  foreach ($options as $option) {
					$inner .= '<option value="'.$option.'">'.$option.'</option>';
				  }
				} else if ($key == "checkboxes") {
				  $skipAttr = explode("\n",$value);
				  $manyType ="checkbox";
				  $isCheckbox = true;
				} else if ($key == "radios") {
				  $skipAttr = explode("\n",$value);
				  $manyType = "radio";
				} else if ($key == "textarea") {
				  if ($field['formtype'] == "m08" || $field['formtype'] == "m10") { //paragraph tags need to convert line breaks to page breaks
					$inner = '>'.str_replace("\n", "<br/>", $value);
				  } else {
					$inner = '>'.$value;
				  }
				} else if ($key == "codearea") {
				  $inner = '>'.html_entity_decode($value);
				} else if ($key == "type" && $value == "number") {
				  $attr .= 'type="number" step="any" ';
				} else if ($key == "regex") {
				  if (!$skipAttr) $attr .= 'pattern="'.$value.'" ';
				} else if ($key == "required") { //this tends to be last in the array
				  if ($value == "true") {
					$attr .= 'required ';
					$pos = strrpos($str, ' <span class="optional">(optional)</span>');
					$str = substr_replace($str, '', $pos, 41);
				  }
				} else if ($key == "help") {
				  $help = $value;
				} else if ($key == "button") {
				  $inner = '>'.$value;
				} else if ($key == "color") {
				  if (strpos($attr, "class=") !== false) {
					  $attr = str_replace('class="', 'class="'.$value.' ', $attr);
				  } else {
					  $attr .= 'class="'.$value.'" ';
				  }
				} else if ($key == "label") {
				  //do nothing, already used above
				} else if ($key == "calculations" || $key == "conditions") {
				  //do nothing
				} else {
				  //key value attributes
				  if ($key == "name" && $isCheckbox) {
					  $value = $value."[]";
					  $isCheckbox = false;
				  }
				  if (!$skipAttr) {
					$attr .= $key.'="'.$value.'" ';
				  } else {
					if ($key != "id" && $key != "value") {
					  $attr .= $key.'="'.$value.'" ';
					} else if ($key == "value") {
					  $defVal = $value;
					}
				  }
				}
			  }
			  if (is_array($skipAttr)) {
				foreach ($skipAttr as $val) {
					$manySelected = "";
					if (isset($defVal)) {
						if ($val == $defVal) {
							$manySelected = "checked ";
						}
					}
					$str .= '<label class="'.$manyType.'"><input type="'.$manyType.'" value="'.$val.'" '.$attr.$manySelected.'/>'.$val.'</label>';
				}
			  } else {
				$str .= $attr.$inner;
				// do special processing for state dropdowns
				if ($field['formtype'] == "s14" || $field['formtype'] == "s15" || $field['formtype'] == "s16")  {
					$str .= '>';
					$str .= ListHelper::getStates($field['formtype']);
				}
				$str .= $this->printFormTypeEnd($field['formtype']);
			  }
			  $str .= '<p class="help-block">'.$help.'</p>';
			  $str .= '</div></div>';
		  }
		}

		$str2 = '</fieldset></form>';

		if (!empty($sections)) {  
		  $section1 = isset($content['settings']['section1']) ? $content['settings']['section1'] : $content['settings']['name'];
		  $nav = '<ul class="form-section-nav"><li class="active">'.$section1.'</li>';
		  foreach ($sections as $idx => $section) {
			$active = $idx === "0" ? ' class="active"' : '';
			$nav .= '<li'.$active.'>'.$section['label'].'</li>';
		  }
		  $nav .= '</ul>';
		  $wrap1 = '<div class="sections-container"><div class="form-section-header active">'.$section1.'</div><div class="form-section active">';
		  $wrap2 = '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><button class="btn btn-lg form-section-next submit">Submit</button></div></div></div>';
		  $str = $nav.$str1.$wrap1.$str.$wrap2.$str2;
		} else {
		  $str = $str1.$str.$str2;
		}
		
		return $str;
	}

	public function isSectional($content) {
		
		foreach ($content['data'] as $field) {
		  if ($field['formtype'] == "m16") return true;
		}
		return false;
		
	}
	
	public function getInputSelector($id, $arr, $checked) {
		$output = "";
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
	
	public function getConditionalStatement($value1, $op, $value2) {
		if ($op == "contains") {
			$output = "(".$value1.").search(/".$value2."/i) != -1";
		} else if ($op == "doesn't contain") {
			$output = "(".$value1.").search(/".$value2."/i) == -1";
		} else {
			$output = $value1." ".$op." '".$value2."'";
		}
		return $output;
	}

	public function wrapJS($str, $sectional, $content) {
		
		$js = "jQuery( document ).ready(function() {"; //start ready
		$js .= "document.getElementById('SFDSWF-Container').innerHTML = '".$str."';";
		$js .= "jQuery('#SFDSWF-Container form').validator();";

		//check content for extra features
		$calculations = [];
		$conditions = [];
		$formtypes = [];
		if ($content) {
			foreach ($content['data'] as $field) {
				$fieldId = $field['id'];
				$formtypes[$fieldId] = $field['formtype'];
				foreach ($field as $key => $value) {
					if ($key == "calculations") { //gather calculations
						$calculations[$fieldId] = $value;
					} else if ($key == "conditions") { //gather conditionals
						$conditions[$fieldId] = $value;
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
						} else if ($val == "Minus") {
							$val2 = "-";
						} else if ($val == "Multiplied by") {
							$val2 = "*";
						} else if ($val == "Divided by") {
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
				
				$js .= "jQuery('".$this->getInputSelector($id, $formtypes, false)."').val(";
				
				$count = 0;
				while ($count < count($calculationIds[$id])) {
					$js .= "parseFloat(jQuery('".$this->getInputSelector($calculationIds[$id][$count], $formtypes, true)."').val())";
					if (isset($calculationOps[$id][$count])) {
						$js .= " ".$calculationOps[$id][$count]." ";
					}
					$count++;
				}
				$js .= 	")";
				$js .= "});";
				
			}
			
		}
		
		if (!empty($conditions)) { //add conditional behavior
			foreach($conditions as $id => $fld) {
				//set default visibility
				$js .= "jQuery('".$this->getInputSelector($id, $formtypes, false)."').closest('.form-group')";
				if ($fld['showHide'] == "Show") {
					$js .= ".hide();";
					$revert = "hide";
				} else if ($fld['showHide'] == "Hide") {
					$js .= ".show();";
					$revert = "show";
				}
				$conditionIds = [];
				$conditionSts = [];
				//loop through each condition
				foreach ($fld['condition'] as $index => $condition) {
					if (!in_array($condition['id'], $conditionIds)) $conditionIds[] = $condition['id'];
					$conditionSts[] = $this->getConditionalStatement("jQuery('".$this->getInputSelector($condition['id'], $formtypes, true)."').val()", $this->getOp($condition['op']), $condition['val']);
				}
				if ($fld['allAny']) {
					//group multiple conditions
					$allConditionSts = implode(" ".$this->getOp($fld['allAny'])." ",$conditionSts);
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
				$js .= "if (".$allConditionSts.") {jQuery('".$this->getInputSelector($id, $formtypes, false)."').closest('.form-group').".strtolower($fld['showHide'])."('medium')} else {jQuery('".$this->getInputSelector($id, $formtypes, false)."').closest('.form-group').".$revert."('medium')}});";
			}
		}

		if ($sectional) { //additional controls for sectional forms
			$js .= "jQuery('#SFDSWF-Container .form-section-nav li').click(function(e){";
			$js .= "var i = jQuery(e.target).prevAll().length;";
			$js .= "SFDSWF_goto(i);";
			$js .= "});";

			$js .= "jQuery('#SFDSWF-Container .form-section-prev').click(function(e) {";
			$js .= "var i = jQuery('.form-section-nav li.active').prevAll('.form-section-nav li').length;";
			$js .= "SFDSWF_goto(i < 1 ? 0 : i-1);";
			$js .= "});";

			$js .= "jQuery('#SFDSWF-Container .form-section-next').click(function(e) {";
			$js .= "var i = jQuery('.form-section-nav li.active').prevAll('.form-section-nav li').length;";
			$js .= "SFDSWF_goto(i+1);";
			$js .= "});";

			$js .= "var SFDSWF_goto = function(i) {";
			$js .= "jQuery('#SFDSWF-Container .form-section-nav li').removeClass('active');";
			$js .= "jQuery('#SFDSWF-Container .form-section-nav li').eq(i).addClass('active');";
			$js .= "jQuery('#SFDSWF-Container .form-section').removeClass('active');";
			$js .= "jQuery('#SFDSWF-Container .form-section').eq(i).addClass('active');";
			$js .= "jQuery('#SFDSWF-Container .form-section-header').removeClass('active');";
			$js .= "jQuery('#SFDSWF-Container .form-section-header').eq(i).addClass('active');";
			$js .= "jQuery('html,body').animate({ scrollTop: 0 }, 'medium');";
			$js .= "}";
		}

		$js .= "});"; //end ready

		return $js;
	}
	
	public function getOp($str) {
		$output = "";
		switch($str) {
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

	public function printFormTypeStart($formtype) {
	  switch ($formtype) {
		/*
		case "i06": //todo prepended text
		case "i08": //todo appended text
		case "i10": //todo prepended checkbox
		case "i12": //todo appended checkbox
		case "m13": //todo file upload
		*/
		case "s08": //input radio do nothing
		case "s06": //input checkbox do nothing
		  $str = "";
		  break;
		case "i14":
		  $str = "<textarea ";
		  break;
		case "s02":
		case "s04":
		case "s14":
		case "s15":
		case "s16":
		  $str = "<select ";
		  break;
		case "m02":
		  $str = "<h1 ";
		  break;
		case "m04":
		  $str = "<h2 ";
		  break;
		case "m06":
		  $str = "<h3 ";
		  break;
		case "m08":
		case "m10":
		  $str = "<p ";
		  break;
		case "m14":
		  $str = "<button ";
		  break;
		case "m16":
		  // form separator handled above
		  break;
		default:
		  $str = "<input ";
	  }
	  return ($str);
	}

	public function printFormTypeEnd($formtype) {
	  switch ($formtype) {
		/*
		case "i06": //todo prepended text
		case "i08": //todo appended text
		case "i10": //todo prepended checkbox
		case "i12": //todo appended checkbox
		case "m13": //todo file upload
		*/
	  case "s08": // input radio do nothing
	  case "s06": // input checkbox do nothing
		break;
	  case "m16":
		// form separator handled above
		break;
	  case "i14":
		$str = "</textarea>";
		break;
	  case "s02":
	  case "s04":
	  case "s14":
	  case "s15":
	  case "s16":
		$str = "</select>";
	  break;
	  case "m02":
		$str = "</h1>";
		break;
	  case "m04":
		$str = "</h2>";
		break;
	  case "m06":
		$str = "</h3>";
		break;
	  case "m08":
	  case "m10":
		$str = "</p>";
	  break;
	  case "m14":
		$str = "</button>";
		break;
	  default:
		$str = "/>";
	  }
	  return ($str);
	}
	
     /**
     * validates form data
     *
     * @return json object
     */
    protected function validateForm(Request $request){
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return false;
        }
        return true;
    }
	
	public function rewriteCSV($content, $filename) {
		$column = 0;
		$write = Array();
		foreach ($content->data as $field) {
			$nonInputs = array("m02", "m04", "m06", "m08", "m10", "m13", "m14", "m16");
			$multipleInputs = array("s02", "s04", "s06", "s08");
			if (in_array($field->formtype, $multipleInputs)) {
				if ($field->formtype == "s02" || $field->formtype == "s04") {
					$options = explode("\n",$field->option);
				} else if ($field->formtype == "s06") {
					$options = explode("\n",$field->checkboxes);
				} else if ($field->formtype == "s08") {
					$options = explode("\n",$field->radios);
				}
				foreach ($options as $option) {
					$write[$column] = isset($field->name) ? $field->name." ".$option : $option;
					$column++;
				}
			} else if (!in_array($field->formtype, $nonInputs)) { // catch all for everything except multiple and non-inputs
				$write[$column] = isset($field->name) ? $field->name : '';
				$column++;
			}
		}
		//file_put_contents('/var/www/html/public/csv/'.$filename, implode(",",$write)."\n");
		$this->writeCSV($filename, implode(",",$write)."\n");
	}

	public function purgeCSV(Request $request) {
      $form_id = $request->input('id');
      $form = Form::where('id', $form_id)->first();
			$content = json_decode($form->content);
			$filename = $this->generateFilename($form_id);
			$this->rewriteCSV($content, $filename);
			return response()->json(['status' => 1, 'message' => 'Purged CSV']); 
 	}
	
	public function processCSV($form, $base_url = '') {
		//read content and settings
		$content = json_decode($form->content);
		if ($this->isCSVDatabase($content->settings->action, $base_url)) {
			$filename = $this->generateFilename($form->id);
			//rewrite header row if CSV is not published (only header row or less exists)
			if (!$this->isCSVPublished($filename)) $this->rewriteCSV($content, $filename);
		}
	}
	
	public function isCSVDatabase($formAction, $base_url = '') {
		$path = '//'. $base_url.'/form/submit';
		//if form action matches a csv transaction
		return substr($formAction,0 - strlen($path)) == $path ? true : false;
	}
	
	public function CSVPublished(Request $request) {
		return $this->isCSVPublished($this->getFilename($request)) ? 1 : 0;
	}
	
	public function isCSVPublished($filename) {
		$csv = $this->readCSV($filename);
		return count($csv) > 1 ? true : false;
	}

	public function readCSV($filename) {
		//$csv = array_map('str_getcsv', file('/var/www/html/public/csv/'.$filename , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
		$csv = array();
		$read = $this->readS3($filename);
		if ($read) {
			$rows = str_getcsv($read,"\n");
			foreach ($rows as $row) {
				$csv[] = str_getcsv($row);
			}
		}
		return $csv;
	}
	
	public function writeCSV($filename, $body) {
		//file_put_contents('/var/www/html/public/csv/'.$filename, implode(",",$write)."\n");
		return $this->writeS3($filename, $body);
	}
	
	public function appendCSV($filename, $arr) {
		$csv = $this->readCSV($filename);
		array_push($csv, $arr);
		$output = "";
		foreach ($csv as $row) {
			$output .= implode(",", $row)."\n";
		}
		$this->writeCSV($filename, $output);
	}
	
	public function submitCSV(Request $request) {
        $form_id = $request->input('form_id');
		if (!$form_id) return "<h1>Oops! Something went wrong.</h1>Please contact SFDS to fix your form.";
        $form = Form::where('id', $form_id)->first();
		$form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
		//print_r($form);
		//todo backend validation
		$column = 0;
		$write = Array();
		foreach ($form['content']['data'] as $field) {
			if ($field['formtype'] == "m02" || $field['formtype'] == "m04" || $field['formtype'] == "m06" || $field['formtype'] == "m08" || $field['formtype'] == "m10" || $field['formtype'] == "m13" || $field['formtype'] == "m14" || $field['formtype'] == "m16") { //do nothing for non inputs
			} else if ($field['formtype'] == "s02" || $field['formtype'] == "s04" || $field['formtype'] == "s06" || $field['formtype'] == "s08") { //multiple options
				if ($field['formtype'] == "s02" || $field['formtype'] == "s04") {
					$options = explode("\n",$field['option']);
				} else if ($field['formtype'] == "s06") {
					$options = explode("\n",$field['checkboxes']);
				} else if ($field['formtype'] == "s08") {
					$options = explode("\n",$field['radios']);
				}
				foreach ($options as $option) {
					if (is_array($request->input($field['name']))) {
						$write[$column] = in_array($option, $request->input($field['name'])) ? 1 : 0;
					} else {
						$write[$column] = $request->input($field['name']) == $option ? 1 : 0;
					}
					$column++;
				}
			} else {
				$write[$column] = $request->input($field['name']);
				//$write[$column] = $field['name']; //todo write first row
				$column++;
			}
		}

		//print_r($write);
		//die;

		/*
		$fp = fopen('/var/www/html/public/csv/'.$this->generateFilename($form_id), 'a');

		//foreach ($write as $fields) {
		  fputcsv($fp, $write);
		//}

		fclose($fp);
		*/
		
		$this->appendCSV($this->generateFilename($form_id), $write);
		
		return redirect($form['content']['settings']['confirmation']);
		//print "Form Submitted!";
		
		//return;
	}

	public function writeS3($filename, $body) {
		//require('../vendor/autoload.php');
		
		/*$s3 = new S3Client([
			'profile' => 'default',
			'version' => 'latest',
			'region' => env('BUCKETEER_AWS_REGION'),
			'credentials' => [
				'key' => env('BUCKETEER_AWS_ACCESS_KEY_ID'),
				'secret' => env('BUCKETEER_AWS_SECRET_ACCESS_KEY')
			]
		]);*/
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
	
	public function readS3($filename) {
		
		/*$s3 = new S3Client([
			'profile' => 'default',
			'version' => 'latest',
			'region' => env('BUCKETEER_AWS_REGION'),
			'credentials' => [
				'key' => env('BUCKETEER_AWS_ACCESS_KEY_ID'),
				'secret' => env('BUCKETEER_AWS_SECRET_ACCESS_KEY')
			]
		]);	*/
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
	
	public function getFilename(Request $request) {
		$id = $request->input('id');
		//todo make sure user has access to this form id
		$path = $request->input('path');
		if ($path) {
			return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$this->generateFilename($id);
		} else {
			return $this->generateFilename($id);
		}
	}
	
	private function generateFilename($id) {
		$hash = substr(sha1($id.env('FILE_SALT')),0,8);
		return $id.'-'.$hash.'.csv';
	}
	
	private function scrubString($str) {
		$scrubbed = htmlspecialchars($str, ENT_NOQUOTES);
		$scrubbed = str_replace("'","&apos;", $scrubbed);
		$scrubbed = str_replace('\"',"", $scrubbed);
		return $scrubbed;
	}
	
	function notifyUser(Request $request) {
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
		  
			if ( connection_aborted() ) break;

			// sleep for 10 second before running the loop again
		  
			sleep(10);
		}
	}
}
