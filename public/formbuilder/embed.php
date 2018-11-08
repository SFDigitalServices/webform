<?php

//load dependencies
require("env.inc");
require("db.inc");

//check GET
if (!isset($_GET['id'])) {
    print "Error. This form does not exist.";
    die;
}

//todo make sure this form is public

//get form
$form = getForm($_GET['id']);;
$sections = array();

$content = json_decode($form['content'], true);

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

print "jQuery( document ).ready(function() {";
print "document.getElementById('SFDSWF-Container').innerHTML = '".$str."';";
//print "jQuery('#SFDSWF-Container').html('".$str."');";
print "jQuery('#SFDSWF-Container form').validator();";

print "jQuery('#SFDSWF-Container .form-section-nav li').click(function(e){";
print "var i = jQuery(e.target).prevAll().length;";
print "SFDSWF_goto(i);";
print "});";

print "jQuery('#SFDSWF-Container .form-section-prev').click(function(e) {";
print "var i = jQuery('.form-section-nav li.active').prevAll('.form-section-nav li').length;";
print "SFDSWF_goto(i < 1 ? 0 : i-1);";
print "});";

print "jQuery('#SFDSWF-Container .form-section-next').click(function(e) {";
print "var i = jQuery('.form-section-nav li.active').prevAll('.form-section-nav li').length;";
print "SFDSWF_goto(i+1);";
print "});";

print "var SFDSWF_goto = function(i) {";
print "jQuery('#SFDSWF-Container .form-section-nav li').removeClass('active');";
print "jQuery('#SFDSWF-Container .form-section-nav li').eq(i).addClass('active');";
print "jQuery('#SFDSWF-Container .form-section').removeClass('active');";
print "jQuery('#SFDSWF-Container .form-section').eq(i).addClass('active');";
print "jQuery('#SFDSWF-Container .form-section-header').removeClass('active');";
print "jQuery('#SFDSWF-Container .form-section-header').eq(i).addClass('active');";
print "jQuery('html,body').animate({ scrollTop: 0 }, 'medium');";
print "}";

print "});"; //end ready

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