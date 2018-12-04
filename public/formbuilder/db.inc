<?php
//all db stuff into this file

function openDB() {
	 // Create connection
	 $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	 // Check connection
	 if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	 } 
	 return $conn;
}

function closeDB($conn) {
	 $conn->close();
}

function getUserById($id) {
	 $conn = openDB();
	 $sql = "SELECT * FROM users WHERE id=".$id;
	 $result = $conn->query($sql);

	 if ($result->num_rows > 0) {
	        // output data of each row
	        while($row = $result->fetch_assoc()) {
			closeDB($conn);
			return $row;
	 	}
	 } else {
                closeDB($conn);
   	   	return array();
	 }
}

function getUserByEmail($email) {
         $conn = openDB();
         $sql = "SELECT * FROM users WHERE email='".$email."'";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                        closeDB($conn);
                        return $row;
                }
         } else {
                closeDB($conn);
                return array();
         }
}

function createUser($email) {
	 $conn = openDB();
	 $sql = "INSERT INTO users (email) VALUES ('".$email."')";
	 if ($conn->query($sql) === TRUE) {
	   $last_id = $conn->insert_id;
	   //todo test by adding a new user to a form and then signing up
	   $sql = "UPDATE user_form SET user_id = '".$last_id."' WHERE user_id = '".$email."'";
	   $conn->query($sql);
           closeDB($conn);
	   return array('id' => $last_id, 'email' => $email);
	 } else {
	   print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
	 }
}

function getUserForms($user_id) { //todo needs testing
         $conn = openDB();
         $sql = "SELECT forms.*, user_form.* FROM forms RIGHT JOIN user_form ON forms.id = user_form.form_id WHERE user_form.user_id=".$user_id;
         $result = $conn->query($sql);

	 $forms = array();
         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
			   $row['content'] = json_decode($row['content'], true);
			   $forms[] = $row;
                }
	 }
         closeDB($conn);
	 return $forms;
}

function getForm($id) {
         $conn = openDB();
         $sql = "SELECT * FROM forms WHERE id=".$id;
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                        closeDB($conn);
                        return $row;
                }
         } else {
                closeDB($conn);
                return array();
         }
}

function createForm($form, $user_id) {
         $conn = openDB();
         $sql = "INSERT INTO forms (content) VALUES ('".json_encode($form['content'])."')";
         if ($conn->query($sql) === TRUE) {
           $last_id = $conn->insert_id;
	   //create new join
           $sql = "INSERT INTO user_form (user_id, form_id) VALUES (".$user_id.", ".$last_id.")";
           $conn->query($sql);
	   $newForm = getForm($last_id);
           closeDB($conn);
           return $newForm;
         } else {
           print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
         }
}

function updateForm($form, $user_id) {
	 //todo parse authors


         $conn = openDB();
         $sql = "UPDATE forms SET content='".json_encode($form['content'])."' WHERE id=".$form['id'];
         if ($conn->query($sql) === TRUE) {
           closeDB($conn);
           return $form;
         } else {
           print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
         }
}

function cloneForm($form_id, $user_id) {
	 $form = getForm($form_id);
	 $content = json_decode($form['content']);
	 $content->settings->name = "Clone of ".$content->settings->name;
	 $form['content'] = $content;
	 //$form['content'] = json_encode($content);
	 unset($form['id']);
	 return createForm($form, $user_id);
}

function deleteForm($id) {
	 //todo check if you're the only author


         $conn = openDB();
         $sql = "DELETE FROM forms WHERE id=".$id;
         if ($conn->query($sql) === TRUE) {
	   $sql = "DELETE FROM user_form WHERE form_id=".$id;
	   if ($conn->query($sql) === TRUE) {
	              closeDB($conn);
          	       return $id;
	   } else {
	     print "Error: ".$sql."<br/>".$conn->error;
	     closeDB($conn);
	   }
         } else {
           print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
	 }
}

function getFormUsers($form_id) { //todo needs testing
         $conn = openDB();
         $sql = "SELECT users.*, user_form.* FROM users RIGHT JOIN user_form ON users.id = user_form.user_id WHERE user_form.form_id=".$form_id;
         //$sql = "SELECT forms.*, user_form.* FROM forms RIGHT JOIN user_form ON forms.id = user_form.form_id WHERE user_form.user_id=".$user_id;
         //$sql = "SELECT users.*, user_form.user_id, user_form.form_id FROM users, INNER JOIN user_form ON users.id = user_form.user_id WHERE user_form.form_id=".$form_id;
         $result = $conn->query($sql);

	 $users = array();
         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
			$users[] = $row;
                }
	}
	closeDB($conn);
	return $users;
}

function listOtherAuthors($form_id, $email) {
	 $users = getFormUsers($form_id);
	 $trim = false;
	 $output = '';
	 foreach ($users as $user) {
	     if ($user['email'] != $email) {
	     	$output .= $user['email'].", ";
		$trim = true;
	     }
	 }
	 $output = $trim ? substr($output, 0, -2) : $output;
	 return $output;
}

function jsonDecode($json, $assoc = false)
{
    $ret = json_decode($json, $assoc);
    if ($error = json_last_error())
    {
        $errorReference = [
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
            JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
            JSON_ERROR_SYNTAX => 'Syntax error.',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
            JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
            JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
            JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
        ];
        $errStr = isset($errorReference[$error]) ? $errorReference[$error] : "Unknown error ($error)";
        throw new \Exception("JSON decode error ($error): $errStr");
    }
    return $ret;
}

// EMBED FUNCTIONS
function generateHTML($content) {

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
		  $str .= printFormTypeStart($field['formtype']);
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
			$str .= printFormTypeEnd($field['formtype']);
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

function isSectional($content) {
	
	foreach ($content['data'] as $field) {
	  if ($field['formtype'] == "m16") return true;
	}
	return false;
	
}

function wrapJS($str, $sectional) {

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

function printFormTypeStart($formtype) {
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

function printFormTypeEnd($formtype) {
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

		       /*

foreach (d in $form) {
  for (key in saved['data'][d]) {
    if (key != "label" && key != "placeholder" && key != "help" && key != "formtype") { //values we don't need to insert
      var curIndex = parseInt(d)+1;
      var inputType = ''; //get input type
      if ($($temptxt).find(".component:eq("+curIndex+") input")) {
	inputType = "input";
      } else if ($($temptxt).find(".component:eq("+curIndex+") select")) {
	inputType = "select";
      } else if ($($temptxt).find(".component:eq("+curIndex+") textarea")) {
	inputType = "textarea";
      }
      if (key == "required") { //required is a different type of attribute
	if (saved['data'][d][key] == "true") {
	  $($temptxt).find(".component:eq("+curIndex+") "+inputType).prop("required", true);
	} else {
	  $($temptxt).find(".component:eq("+curIndex+") "+inputType).removeAttr("required");
	}
      } else if (key == "regex") { //regex is entered as pattern
	$($temptxt).find(".component:eq("+curIndex+") "+inputType).attr("pattern", saved['data'][d][key]);
      } else if (key == "value" && inputType == "textarea") { //syntax is different
	$($temptxt).find(".component:eq("+curIndex+") "+inputType).html(saved['data'][d][key]);
      } else { //everything else gets added to input
	$($temptxt).find(".component:eq("+curIndex+") "+inputType).attr(key, saved['data'][d][key]);
      }
    }
  }
}
		       */

?>
