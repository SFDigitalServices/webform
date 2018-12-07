<?php
namespace App\Http\Controllers;

use App\Form;
use Auth;
use App\User_Form;
use Validator;

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
            'getForm'
            ]]);
    }

    public function getIndex(Request $request){
        return response()->json('all');
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
		//$form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
        
        return response()->json($form);
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
			$returnForm['content'] = $request->input('content');
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
        $form_id = $request->input('form_id');
        $form = Form::where('id', $form_id)->first();
        
        if($form){
            $content = json_decode($form['content']);
            //return $content->settings->name;
            $content->settings->name = "Clone of ".$content->settings->name;
            $cloned_form = Form::create(['content' => json_encode($content)] );

            if( $cloned_form ){
                // create entry in user_form
                $user_id = $request->input('user_id');
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
     * Creates a new form for the current logged in user.
     *
     * @return json object
     */
    public function create(Request $request) {
        // validate form data
        if( $this->validateForm($request) ) {
            $form = Form::create(['content' => $request->input('content')] );
            
            if( $form ){
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

		$content = json_decode($form['content'], true);

		return wrapJS(generateHTML($content),isSectional($content));
   }

	 /**
     * Creates HTML for the form
     *
     * @return HTML
     */
    public function generateHTML(Request $request){
        $form_id = $request->input('id');
        $form = Form::where('id', $form_id)->first();
		//$form['content'] = json_decode($form['content'], true); //hack to convert json blob to part of larger object
		$sections = array();

		$content = json_decode($form['content'], true);

		return generateHTML($content);
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
        if( $user_form_delete ){ //todo check if no more users own that form, then delete
            $form_delete = Form::where([['id', $form_id]])->delete();
            if( $form_delete ){
                 return response()->json(['status' => 1, 'message' => 'Deleted form from user']); 
            }
        }
       return response()->json(['status' => 0, 'message' => 'Failed to delete form']);      
    }
	
	// EMBED FUNCTIONS
	public function generateHTML($content) {

		$str1 = '<form class="form-horizontal" action="'.$content['settings']['action'].'" method="'.$content['settings']['method'].'"><fieldset><div id="SFDSWFB-legend"><legend>'.$content['settings']['name'].'</legend></div>';
		$str = '';

		foreach ($content['data'] as $field) {
		  if ($field['formtype'] == "m16") { //special parsing for form sections
			  $sections[] = $field;
			  $str .= '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id="'.$field['id'].'">'.$field['label'].'</div><div class="form-section" data-id="'.$field['id'].'">';
		  } else {
			  $str .= '<div class="form-group" data-id="'.$field['id'].'"><label class="control-label">';
			  $str .= isset($field['label']) ? $field['label'] : "";
			  $str .= '</label><div>';
			  $str .= $this->printFormTypeStart($field['formtype']);
			  $skipAttr = false;
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
				} else if ($key == "radios") {
				  $skipAttr = explode("\n",$value);
				  $manyType = "radio";
				} else if ($key == "textarea") {
				  $inner = '>'.$value;
				} else if ($key == "codearea") {
				  $inner = '>'.html_entity_decode($value);
				} else if ($key == "regex") {
				  if (!$skipAttr) $attr .= 'pattern="'.$value.'" ';
				} else if ($key == "required") { //this tends to be last in the array
				  $attr .= 'required '; //todo check if required needs to change for radio and checkboxes
				} else if ($key == "help") {
				  $help = $value;
				} else if ($key == "button") {
				  $inner = '>'.$value;
				} else if ($key == "color") {
				  $attr .= 'class="btn-'.strtolower($value).'" ';
				} else if ($key == "label") {
				  //do nothing, already used above
				} else {
				  //key value attributes
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

	public function wrapJS($str, $sectional) {

		$js = "jQuery( document ).ready(function() {"; //start ready
		$js .= "document.getElementById('SFDSWF-Container').innerHTML = '".$str."';";
		$js .= "jQuery('#SFDSWF-Container form').validator();";

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
}
