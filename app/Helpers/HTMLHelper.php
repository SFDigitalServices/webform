<?php
namespace App\Helpers;

use Log;
use App\Helpers\ListHelper;

class HTMLHelper
{
    protected $controllerHelper;
    protected $dataStoreHelper;

    /** Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->controllerHelper = new ControllerHelper();
      $this->dataStoreHelper = new DataStoreHelper();
    }

     /** Generates form field HTML
     *
     * @param $form
     *
     * @return HTML
     */

    public function getHTML($form)
    {
        $content = $form['content'];
        $formid = $form['id'];
        // form setting (json)
        $formEncoding = $this->controllerHelper->hasFileUpload($content['data']) ? ' enctype="multipart/form-data"' : '';

        $form_div = '<form id="SFDSWFB_forms_'.$formid.'" class="form-horizontal" action="'.$content['settings']['action'].'" method="'.$content['settings']['method'].'" '.$formEncoding.'>';

        $form_container = '';
        $sections = [];

        $pageCount = $this->totalPages($content['data']);

        //if this form is a csv transaction, add form_id.
        if( isset($content['settings']['backend']) ) {
            $form_container .= '<input type="hidden" name="form_id" value="'.$form['id'].'"/>';
        }

        // looping through all form fields.
        foreach ($content['data'] as $field) {
          if(! isset($field['formtype']))
            continue;
          if ($field['formtype'] == "m14") {
            // Submit button
            if (empty($sections)) $form_container .= $this->createEditableFields($field);
          } else if ($field['formtype'] == "m16") {
            // Page separators
            // This loop excludes the first page (see $form_wrapper_top)

            $pageNumber= (sizeof($sections) + 1);

            $form_container .= $this->formSection($content['settings']['name'], $field, $pageNumber, $pageCount);

            $sections[] = $field;

            // All other static / hidden field types start
            // with the letter "m", except for file uploads (m13)
          } else if ($field['formtype'] !== "m13" && $field['formtype'][0] == "m") {
            $form_container .= $this->createContentAndHiddenFields($field);
          } else {
            $form_container .= $this->createEditableFields($field);
          }
        }
        // Form Sections
        if (!empty($sections)) {
            $section1 = isset($content['settings']['section1']) ? $content['settings']['section1'] : $content['settings']['name'];
            $firstSectionHeader = self::formSectionHeader($content['settings']['name'], 1, $section1, 1, $pageCount);
            $form_wrapper_top = '<div class="sections-container"><div class="form-section active">'.$firstSectionHeader.'<div class="form-content">';
            $form_wrapper_bottom = self::pagination($pageCount, $pageCount).'</div></div>';
            $form_container = $form_div. $form_wrapper_top. $form_container. $form_wrapper_bottom;
        } else {
            $form_container = $form_div . self::formHeader($content['settings']['name']) . $form_container;
        }
        // add preview page place holder
        $form_end = "";
        if($pageCount > 1)
          $form_end = self::addPreviewPage($content['settings']['name']);

        if (isset($content['settings']['backend']) && $content['settings']['backend'] === 'csv') {
          if(isset($content['settings']['save-for-later']) && $content['settings']['save-for-later'] !== 'true')
            $form_end .= '</div';
          else
            $form_end .= '</div><div class="form-group" data-id="saveForLater"><label for="saveForLater" class="control-label"></label><div class="field-wrapper"><a href="javascript:submitPartial('.$formid.')" >Save For Later</a></div></div>';
        }
        $form_end .= '</form>';
        // clean up line breaks, otherwise embedjs will fail
        return preg_replace("/\r|\n/", "", $form_container . $form_end);
    }

    /**
    * Creates an admin tab for the form preview
    *
    * @return HTML
    */
    public function adminTab()
    {
        $html = '<div id="SFDSWFB-admin">'.
          '<div class="header" onclick="toggleAdminTab()">Administrative Tools <i class="adminTabArrow fa fa-angle-up"></i></div>'.
          '<div class="content">'.
            'Show All Questions &nbsp; <input type="checkbox" onclick="toggleShowAllFields(this)"/><br/>'.
            'Show all Pages &nbsp; <input type="checkbox" onclick="toggleShowAllPages(this)"/>'.
          '</div>'.
        '</div>';
        return $html;
    }

    /** Create js string for embed code
    *
    * @param $form
    * @param $base_url
    * @param $referer
    *
    * @return string
    */
  public function wrapJS($form, $host = '', $referer = '')
  {
      $str = $this->getHTML($form, $host);
      $sectional = $this->isSectional($form['content']);

      $js = "var SFDSWFB = {};SFDSWFB.preRenderScripts = [" .
		"'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', " .
		"'//" . $host . "/assets/js/validator.js', " .
		"'//" . $host . "/assets/js/error-msgs.js', " .
    "'//cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js'" .
	  "];SFDSWFB.postRenderScripts = [" .
		"'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js'" .
	  "];var script = document.createElement('script'); SFDSWFB.formRender = function() {"; //start ready

      $js .= "document.getElementById('SFDSWF-Container').innerHTML = '".$str."';";
      $js .= "if (typeof SFDSerrorMsgs != 'undefined') { SFDSerrorMsgs(); } else { jQuery('#SFDSWF-Container form').validator(); }";

      //check content for extra features
      $calculations = [];
      $conditions = [];
      $webhooks = [];
      $formtypes = [];
      $fileFields = array();
      if ($form['content']) {
          foreach ($form['content']['data'] as $field) {
              if(!isset($field['id']))
                Log::info(print_r($field, 1));
              $fieldId = $field['id'];
              if (isset($field['formtype'])) {
                  $formtypes[$fieldId] = $field['formtype'];
                  if ($field['formtype'] === 'm13') {
                      $fileFields[] = $fieldId;
                  }
              }
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
              $js = substr($js, 0, -2)."').on('blur change',function(){";

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
              $js .= $calcFunc . ";";
          }
      }

      if (!empty($conditions)) { //add conditional behavior
          $hasConditions = array();
          foreach ($conditions as $id => $fld) {
              //set default visibility
              if ($formtypes[$id] == "m16") {
                $js .= "jQuery('".$this->getInputSelector($id, $formtypes, false)." .form-group')";
              } else {
                $js .= "jQuery('".$this->getInputSelector($id, $formtypes, false)."').closest('.form-group')";
              }
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
                  $conditionSts[] = $this->generateConditionalStatement($this->getInputSelector($condition['id'], $formtypes, true), $condition['op'], $condition['val'], $formtypes[$condition['id']]);
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
                  if( ! in_array($chId, $hasConditions) )
                    $hasConditions[] = $chId;
              }
              $js = substr($js, 0, -2)."').on('blur change',function(){";

              $getInputSelector = $this->getInputSelector($id, $formtypes, false);
              if ($formtypes[$id] == "m16") {
                $js .= "if (".$allConditionSts.") {jQuery('".$getInputSelector." .form-group').".strtolower($fld['showHide'])."()} else {jQuery('".$getInputSelector." .form-group').".$revert."()}});";
              } else {
                $js .= "if (".$allConditionSts.") {jQuery('".$getInputSelector."').closest('.form-group').".strtolower($fld['showHide'])."()} else {jQuery('".$getInputSelector."').closest('.form-group').".$revert."()}});";
              }
          }
      }

      if ($sectional) { //additional controls for sectional forms
          $js .= "initSectional();";
      }

      //add webhooks behavior
      $js .= $this->addWebhooks($webhooks, $formtypes);
      // check to see if this is a retrieval
      $populateJS = '';
      if($referer !== ''){
        $query = parse_url($referer, PHP_URL_QUERY);
        parse_str($query, $output);
        if(isset($output['draft'])){
          $draft = $output['draft'];
          $form_id = $output['form_id'];
          $data['data'] = $this->dataStoreHelper->retrieveFormDraft($form_id, $draft);
          if(isset($hasConditions))
            $data['conditions'] = $hasConditions;
            $data['fileFields'] = $fileFields;
          $populateJS = "var draftData = ". json_encode($data) .";";
        }
      }
      $js .= "};script.src = '//".$host."/assets/js/embed.js';var s = document.createElement('script');s.setAttribute('type', 'text/javascript'); s.text='$populateJS';document.head.append(s);document.head.appendChild(script);"; //end ready
      return $js;
  }

  /** Create js string for webhooks
  *
  * @param $webhooks
  * @param $formtypes
  *
  * @return string
  */
  public function addWebhooks($webhooks, $formtypes) {
    $js = '';
    if (!empty($webhooks)) {
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
        $js .= "callWebhook('" . $id . "', '" . $fld['endpoint'] . "', Array(";
        foreach ($webhookIds as $whId) {
          $js .= "'" . $whId . "',";
        }
        $js = substr($js, 0, -1);
        $js .= "), '" . $fld['responseIndex'] . "', '" . $fld['method'] . "', " . $fld['optionsArray'] . $delimiter . $responseOptionsIndex . ");";
        $js .= '});';
      }
    }
    return $js;
  }

    /** Calculate total pages
     *
     * @param $array
     *
     * @return totalPages
     */
    public function totalPages($array) {
      if (in_array("m16", array_column($array, "formtype"))) {
        $totalPages = ((array_count_values(array_column($array, 'formtype'))["m16"]) + 1);
      }
      else {
        $totalPages = 1;
      }
      return $totalPages;
    }

    /** Generate header
     *
     * @param $formName
     *
     * @return html
     */

    public static function formHeader($formName) {
      return '<header class="hero-banner default"><div class="form-header-meta"><p>'.$formName.'</p></div></header>';
    }

    /** Generate section header
     *
     * @param $formName, $id, $pageName, $pageNumber, $pageCount
     *
     * @return html
     */
    public static function formSectionHeader($formName, $id, $pageName, $pageNumber, $pageCount) {
      $html = '<header class="hero-banner default" id="form_page_'. $pageNumber .'">';
      $html .= '<div class="form-header-meta">';
      $html .= '<p>'.$formName.'</p>';

      // Progress bar
      if ($pageCount > 1) {
        $html .= '<div class="form-progress">';
        if ($pageCount > 5) {
          $percentDone = round(($pageNumber / $pageCount) * 100);
          $html .= '<div role="progressbar" aria-valuenow="'. $percentDone .'" aria-valuemin="0" aria-valuemax="100" class="form-progress-bar form-progress-bar-'. $percentDone .'">'. $percentDone .'% done</div>';
        } else {
          $html .= '<div class="form-progress-bubble">Page '. $pageNumber .' of '. $pageCount .'</div>';
        }
        $html .= '</div>';
      }

      // Close .form-header-meta
      $html .= '</div>';

      $html .= '<h1 class="form-section-header" data-id="'.$id.'">'.$pageName.'</h1></header>';
      return $html;
    }

    //** Generate pagination block
    // *
    // * @param $pageNumber, $pageCount
    // *
    // * @return html
    // */
    public static function pagination($pageNumber, $pageCount) {
      $html = '<div class="form-group">';

      if ($pageNumber > 1) {
        $html .= '<button class="btn btn-lg form-section-prev">Previous</button>';
      }

      if ($pageNumber == $pageCount) {
        // insert Preivew page, move submit button to the Preview page
        $html .= '<button id="preview_submit_page" class="btn btn-lg form-section-next">Next</button>';
      } else {
        $html .= '<button class="btn btn-lg form-section-next">Next</button>';
      }

      // Close .form-group
      $html .= '</div>';

      return $html;
    }


    /** Generate Section element
     *
     * @param $field, $pageNumber, $pageCount
     *
     * @return html
     */
    public static function formSection($name, $field, $pageNumber, $pageCount) {
      $html = self::pagination($pageNumber, $pageCount);

      // - Close the previous .form-content and .form-section
      // - Open the next .form-section
      $html .= '</div></div><div class="form-section" data-id="'.$field['id'].'">';

      $html .= self::formSectionHeader($name, $field['id'], $field['label'], ($pageNumber + 1), $pageCount);

      // - Open the next .form-content
      $html .= '<div class="form-content">';

      return $html;
    }

    /** Generate Other element
     *
     * @param $field
     *
     * @return html, will return empty string if "other" is not selected or null</select>
     */
    public static function formOther($field) {
      $html = "";

      if (isset($field['version']) && $field['version'] === "other") {
        switch ($field['formtype']) {
          case "s08": //radio
            $type = "radio";
            $array = "";
            $extra = "";
            break;
          case "s06": //checkbox
            $type = "checkbox";
            $array = "[]";
            $extra = self::isRequired($field) ? ' data-required="1" data-error="This field cannot be blank."' : '';
            break;
        }
        //js added inline instead of from JS due to simplicity of binding
        $html .= '<label class="other-label '.$type.'" for="'.$field['id'].'_Other" onclick="insertOtherTextInput(this)" data-fieldname='.$field['name'].'_Other><input type="'.$type.'" value="Other" id="'.$field['id'].'_Other" name="'.$field['name'].$array.'" data-formtype="'.$field['formtype'].'"'.$extra.'><span class="inline-label">Other</span></label>';
      }

      return $html;
    }

    /** Generate Radio input element
    *
    * @param $field
    *
    * @returns html
    */
    public static function formRadio($field)
    {
        $html = "";
        $other = self::formOther($field);
        unset($field['version']);

        //id is set per option
        $field_id = isset($field['id']) ? $field['id'] : "";
        unset($field['id']);
        //convert radios to options and remove them from fields
        $options = isset($field['radios']) ? $field['radios'] : array();
        unset($field['radios']);
        //get attributes
        $attributes = self::setAttributes($field);
        //construct radio inputs, one or more
        if (!empty($options)) {
            foreach ($options as $option) {
                $id = str_replace(' ', '_', $field_id . '_' . $option);
                $html .= '<label for="'.$id.'"><input type="radio" id="'.$id.'" value="'.$option.'"'.$attributes.'/><span class="inline-label">'.$option.'</span></label>';
            }
        }
        $html .= $other;
        return $html;
    }

   /** Generate Checkbox input element
    *
    * @param $field
    *
    * @returns html
    */
    public static function formCheckbox($field)
    {
        $html = "";
        $other = self::formOther($field);
        unset($field['version']);
        //name needs to be an array
        $field['name'] = isset($field['name']) && $field['name'] != "" ? $field['name'] . "[]" : "";
        //id is set per option
        $field_id = isset($field['id']) ? $field['id'] : "";
        unset($field['id']);
        //convert checkboxes to options and remove them from fields
        $options = isset($field['checkboxes']) ? $field['checkboxes'] : array();
        unset($field['checkboxes']);
        if (self::isRequired($field)) $field['data-required'] = true;
        //get attributes
        $attributes = self::setAttributes($field);
        //construct checkbox inputs, one or more
        if (!empty($options)) {
            foreach ($options as $option) {
                $id = str_replace(' ', '_', $field_id . '_' . $option);
                $html .= '<label for="'.$id.'"><input type="checkbox" id="'.$id.'" value="'.$option.'"'.$attributes.'/><span class="inline-label">'.$option.'</span></label>';
            }
        }
        $html .= $other;
        return $html;
    }

  /** Generate Text element
     *
     * @param $field
     *
     * @returns html
     */
    public static function formText($field)
    {
        $attributes = self::setAttributes($field);
        $prepended = self::getPrepended($field);
        $html = $prepended . "<input" . $attributes . "/>";
        if (isset($field['unit']) && $field['formtype'] == "d06" && $field['unit'] != "") $html = $html . '<span class="units">' . $field['unit'] . '</span>';
        return $html;
    }

   /** Generate TextArea element
    *
    * @param $field
    *
     * @returns html
     */
    public static function formTextArea($field)
    {
        $attributes = self::setAttributes($field);
        $textarea = isset($field['textarea']) ? $field['textarea'] : "";
        $textarea = str_replace("\n", "<br/>", $textarea);
        $html = '<textarea'. $attributes .'>'.$textarea.'</textarea>';
        return $html;
    }

    /** Generate Select element
     *
    * @param $field
    *
    * @returns html
    */
    public static function formSelect($field)
    {
        $attributes = self::setAttributes($field);
        $html = '<select'. $attributes .'>';

        // need to check for formtypes: s02, s04, s14, s15, s16
        if ($field['formtype'] == "s14" || $field['formtype'] == "s15" || $field['formtype'] == "s16") {
            $html .= self::getStates($field['formtype']);
        } elseif (isset($field['option'])) {
            $html .= '<option value="">Choose an option</option>';
            foreach ($field['option'] as $option) {
                $html .= '<option value="'.$option.'">'.$option.'</option>';
            }
        }
        $html .= '</select>';
        return $html;
    }
    /**
     * Generate File Upload element
     *
     * @returns html
     */
    public static function formFile($field)
    {
        $attributes = self::setAttributes($field);
        $prepended = self::getPrepended($field);
        $html = $prepended . '<label>';
        $html .= '<span class="label">'. $field['label'] . '</span>';
        $html .= '<div'. $attributes.' class="dz-message file-custom" data-required-error="You need to upload a file."><span class="dragndrop"><button type="button">Choose a file</button> Drop files here or click to upload.</span></div>';
        $html .= '</label>';
        return $html;
    }

    /** Generate Prepeded element
     *
     * @param $field
     *
     * @returns html
     */
    public static function getPrepended($field)
    {
        $html = "";
        if ($field['formtype'] == "d08") { //so far for price
            $html = '<div class="prepended dollar">$</div>';
        }
        return $html;
    }


  /** Generate Button element
    *
    * @param $field
    *
    * @returns html
    */
    public static function formButton($field)
    {
        $button = isset($field['button']) ? $field['button'] : "";
        $attributes = self::setAttributes($field);

        $html = '<input type="submit" value="' . $button . '"' .$attributes .'/>';
        return $html;
    }

  /** Generate paragraph element
    *
    * @param $field
    *
    * @returns html
    */
    public static function formParagraph($field)
    {
        // type and formtype are not valid attributes for accessibility.
        $attributes = self::setAttributes($field);

        if ($field['formtype'] == "m08") {
            $field_value = isset($field['textarea']) ? str_replace("\n", "<br/>", $field['textarea']) : "";
        } elseif ($field['formtype'] == "m10") {
            $field_value = isset($field['codearea']) ? html_entity_decode($field['codearea']) : "";
        } else {
            $field_value = ''; //should not happen
        }

        $html = '<p'. $attributes .'>'.$field_value.'</p>';
        return $html;
    }

   /** Generate H tag element
    *
     * @param $field
     *
    * @returns html
    */
    public static function formHtag($field)
    {
        // type and formtype are not valid attributes for accessibility.
        $html = "";
        $attributes = self::setAttributes($field);

        $textarea = isset($field['textarea']) ? str_replace("\n", "<br/>", $field['textarea']) : "";
        switch ($field['formtype']) {
            case "m02":
                $html = '<h1'. $attributes.'>'.$textarea.'</h1>';
                break;
            case "m04":
                $html = '<h2'. $attributes.'>'.$textarea.'</h2>';
                break;
            case "m06":
                $html = '<h3'. $attributes.'>'.$textarea.'</h3>';
                break;
        }
        return $html;
    }

  /** Generate hidden element
    *
    * @return html
    */
    public static function formHidden($field)
    {
        //this one probably needs value!
        $value = isset($field['value']) ? ' value="'.$field['value'].'"' : "";
        $attributes = self::setAttributes($field);

        return '<input'.$attributes.$value.'/>';
    }

  /** Constructs label
    *
     * @param $field
     *
     * @return html
     */
    public static function fieldLabel($field)
    {
        $legends = array('s06', 's08');
        $non_inputs = array('m02', 'm04', 'm06', 'm08', 'm10', 'm11', 'm14', 'm16'); //m13 is file upload
        $label_for = isset($field['id']) && $field['id'] !== "" ? $field['id'] : $field['name']; //this shouldn't happen as id should be required
        $label_text = isset($field['label']) ? $field['label'] : "";
        //$optional = !self::isRequired($field) && !in_array($field['formtype'], $non_inputs) ? ' <span class="optional">(optional)</span>' : "";
        $optional = '';
        if (in_array($field['formtype'], $legends)) {
          $start = '<legend class="control-label">';
          $end = '</legend>';
        } else {
          $start = '<label for="'.$label_for.'" class="control-label">';
          $end = '</label>';
        }

        return $start . $label_text . $optional . $end;
    }

    public static function isRequired($field) {
      $ret = false;
      if (isset($field['required'])) {
        if ($field['required'] === true || $field['required'] === "true" || $field['required'] === "1" || $field['required'] === 1) $ret = true;
      }
      return $ret;
    }

   /** Constructs help text block
     *
     * @param $field
     *
     * @return html
     */
    public static function helpBlock($field)
    {
      $output = '<div class="help-block with-errors" id="SFDSWF-'.$field['id'].'-with-errors"></div>';
      if (isset($field['help']) && $field['help'] !== "") {
        $output .= '<p class="help-text">'.html_entity_decode($field['help']).'</p>';
      }
      return $output;
    }

     /** Formats submitted data for preview
     *
     * @param $request
     * @param @form
     *
     * @return html
     */
    public function formatSubmittedData($request, $form)
    {
      $ret = array();
      $internal = array();
      $external = array();
      $data = $request->all();
      $definitions = $form['data'];

      foreach($definitions as $definition){
        if (isset($definition['formtype']) && $this->controllerHelper->isNonInputField($definition['formtype'])) {
            continue;
        }
        if ($definition) {
            if (isset($definition['formtype']) && ($definition['formtype'] == 's06' || $definition['formtype'] == 's08')) {
                $type = $definition['formtype'];
            } else {
                $type = isset($definition['formtype']) ? $definition['formtype'] : $definition['type'];
            }
            $name= isset($definition['name']) ? $definition['name'] : $definition['id'];
            $value = isset($data[$name]) ? $data[$name] : "";
            $label = isset($definition['label']) ? ucfirst($definition['label']) : ucfirst($name);

            if ($value != "") {
                switch ($type) {
                  case 'c04':
                  case 'email': // format emals
                    $ret[] = FieldFormatter::formatEmail($label, $value);
                    break;
                  case 'd10':
                  case 'url': // format url
                    $ret[] = FieldFormatter::formatURL($label, $value);
                    break;
                  case 'c06':
                  case 'tel': // format phone
                    $ret[] = FieldFormatter::formatPhone($label, $value);
                    break;
                  case 's02':
                  case 's14':
                  case 's15':
                  case 's16': // dropdowns, radios, checkbox put a check mark before the value
                  case 's08':
                  case 's06':
                    $ret[] = FieldFormatter::formatOptions($label, $value, $request->getSchemeAndHttpHost());
                    break;
                  case 'm13':
                  case 'file': // format name and size
                    $file = null;
                    if ($request->file($name) != null && $request->file($name)->isValid())
                        $file = $request->file($name);

                    $external[] = FieldFormatter::formatFile($label, $value, $file);
                    if (isset($form['settings']['cc-internal-staff']) && $form['settings']['cc-internal-staff'] !== '')
                        $internal[] = FieldFormatter::formatFile($label, $value, $file, true);
                    break;
                  case 'd06':
                  case 'number': // format number, append units
                    $unit = isset($definition['unit']) ? $definition['unit'] : "";
                    $ret[] = FieldFormatter::formatNumber($label, $value, $unit);
                    break;
                  case 'd08':
                  case 'price': // format currency
                    $ret[] = FieldFormatter::formatPrice($label, $value);
                    break;
                  case 'd02':
                  case 'date': // format date
                    $ret[] = FieldFormatter::formatDate($label, $value);
                    break;
                  case 'i14': // format textarea, strip all html
                    $ret[] = FieldFormatter::formatTextArea($label, $value);
                    break;
                  case 'd04': // format Time
                  case 'time':
                    $ret[] = FieldFormatter::formatTime($label, $value);
                    break;
                  default: //format all other inputs as text
                    $ret[] = FieldFormatter::formatText($label, $value);
                    break;
              }
            }
        }
      }
      $formatted_data = array();
      $formatted_data['internal'] = array_merge($ret, $internal);
      $formatted_data['external'] = array_merge($ret, $external);
      //Log::info(print_r($formatted_data, 1));
      return $formatted_data;
    }

    /**
    * adds a preview page to the last page
    *
    * @param $formname
    *
    * @return HTML
    */
    private static function addPreviewPage($formname)
    {
        $html = '<div class="form-section" data-id="page_separator">'.self::formHeader($formname).'<div class="form-content">';
        // add place holders for preview page
        $html .= '<div class="form-group">';
        $html .= '<div id="preview_submitted_data"></div>';
        $html .= '</div>';
        // add buttons
        $html .= '<div class="form-group">';
        $html .= '<button class="btn btn-lg form-section-prev">Previous</button>';
        $html .= '<input type="submit" id="submit" value="Submit" class="btn btn-lg form-section-submit"/>';
        $html .= '</div></div>';

        return $html;
    }


   /** Strips field attributes by formType
     *
     * @param $field
     *
     * @return field array
     */
    private static function stripAttributesByFormType($field) {
		switch ($field['formtype']) {
			case 'c06': //phone
			case 'd02': //date
				unset($field['minlength']);
				unset($field['maxlength']);
				break;
			case 'i14': //textarea
				unset($field['type']);
				break;
			case 's02': //dropdown
			case 's06': //checkboxes
			case 's08': //radios
			case 's14': //dropdown
			case 's15': //dropdown
			case 's16': //dropdown
				unset($field['type']);
				unset($field['minlength']);
				unset($field['maxlength']);
				break;
			case 'm02': //h1
        unset($field['name']);
        unset($field['type']);
        unset($field['minlength']);
        unset($field['maxlength']);
        unset($field['required']);
        break;
			case 'm04': //h2
        unset($field['name']);
        unset($field['type']);
        unset($field['minlength']);
        unset($field['maxlength']);
        unset($field['required']);
        break;
			case 'm06': //h3
        unset($field['name']);
        unset($field['type']);
        unset($field['minlength']);
        unset($field['maxlength']);
        unset($field['required']);
        break;
			case 'm08': //p
        unset($field['name']);
        unset($field['type']);
        unset($field['minlength']);
        unset($field['maxlength']);
        unset($field['required']);
        break;
			case 'm10': //p html
        unset($field['name']);
				unset($field['type']);
				unset($field['minlength']);
				unset($field['maxlength']);
				unset($field['required']);
				break;
			case 'm11': //hidden
				unset($field['minlength']);
				unset($field['maxlength']);
				unset($field['required']);
				unset($field['class']);
				break;
			case 'm13': //file uploads
				unset($field['minlength']);
				unset($field['maxlength']);
				break;
			case 'm14': //button
				unset($field['button']);
				unset($field['type']);
				unset($field['minlength']);
				unset($field['maxlength']);
				unset($field['required']);
				break;
			default:
				break;
		}
		return $field;
	}

   /** Process fields by type, adds steps to numbers, and strips invalid validators
     *
     * @param $field
     *
     * @returns field array
     */
    private static function processFieldsByType($field)
    {
        if (isset($field['type'])) {
            if (in_array($field['type'], array("number", "date", "price"))) {
                if ($field['formtype'] == "d08") {
                    $field['step'] = '0.01';
                } else {
                    $field['step'] = 'any';
                }
            } else {
                unset($field['min']);
                unset($field['max']);
            }
            if ($field['type'] != "regex") {
                unset($field['regex']);
            }
            if ($field['type'] != "match") {
                unset($field['match']);
            }
        } else {
            unset($field['min']);
            unset($field['max']);
            unset($field['regex']);
            unset($field['match']);
        }
        return $field;
    }

  /** Constructs field attributes
    *
     * @param $field
     *
     * @returns attribute string
     */
    private static function setAttributes($field)
    {
        $html = '';

        //unset unused attributes
        unset($field['label'], $field['help']);
        unset($field['conditions'], $field['calculations'], $field['webhooks']);
        unset($field['codearea'], $field['textarea'], $field['option'], $field['checkboxes'], $field['radios']); //content, not attributes
        unset($field['value']); //deprecated

        //strip attributes for specific formTypes, this is for handling extraneous/bad data
        $field = isset($field['formtype']) ? self::stripAttributesByFormType($field) : $field;

        //strip attributes for specific types, this is for handling extraneous/bad data
        $field = self::processFieldsByType($field);

        //add color to the class in the case of buttons
        $color = isset($field['color']) ? ' ' . $field['color'] : "";
        $field['class'] = isset($field['class']) ? $field['class'] . $color : $color;
        unset($field['color']);

        foreach ($field as $key => $value) {
            if ($value == '' || $key == 'unit') {
                //fields with empty values are skipped
            } elseif ($key == 'type' && ($value == 'regex' || $value == 'match')) {
                $html .= ' type="text"';
            } elseif ($key == 'regex') {
                $html .= ' pattern="'.$value.'"';
            } elseif ($key == "match") {
                $html .= ' data-match="#'.$value.'"';
            } elseif ($key == "required") {
                if ($value == "true") {
                    $html .= ' required';
                }
            } elseif ($key == "formtype") {
                $html .= ' data-formtype="'. $value . '"';
            } else {
                $html .= ' '. $key .'="'. $value . '"';
            }
        }
        return $html;
    }

    /** Gets a list of states
     *
     * @param $formType
     *
     * @returns html
     */
  private static function getStates($formType)
  {
      if ($formType == "s14") {
          $str = '<option value="">Choose an option</option><option value="alabama">Alabama</option><option value="alaska">Alaska</option><option value="arizona">Arizona</option><option value="arkansas">Arkansas</option><option value="california">California</option><option value="colorado">Colorado</option><option value="connecticut">Connecticut</option><option value="delaware">Delaware</option><option value="district-of-columbia">District Of Columbia</option><option value="florida">Florida</option><option value="georgia">Georgia</option><option value="hawaii">Hawaii</option><option value="idaho">Idaho</option><option value="illinois">Illinois</option><option value="indiana">Indiana</option><option value="iowa">Iowa</option><option value="kansas">Kansas</option><option value="kentucky">Kentucky</option><option value="louisiana">Louisiana</option><option value="maine">Maine</option><option value="maryland">Maryland</option><option value="massachusetts">Massachusetts</option><option value="michigan">Michigan</option><option value="minnesota">Minnesota</option><option value="mississippi">Mississippi</option><option value="missouri">Missouri</option><option value="montana">Montana</option><option value="nebraska">Nebraska</option><option value="nevada">Nevada</option><option value="new-hampshire">New Hampshire</option><option value="new-jersey">New Jersey</option><option value="new-mexico">New Mexico</option><option value="new-york">New York</option><option value="north-carolina">North Carolina</option><option value="north-dakota">North Dakota</option><option value="ohio">Ohio</option><option value="oklahoma">Oklahoma</option><option value="oregon">Oregon</option><option value="pennsylvania">Pennsylvania</option><option value="rhode-island">Rhode Island</option><option value="south-carolina">South Carolina</option><option value="south-dakota">South Dakota</option><option value="tennessee">Tennessee</option><option value="texas">Texas</option><option value="utah">Utah</option><option value="vermont">Vermont</option><option value="virginia">Virginia</option><option value="washington">Washington</option><option value="west-virginia">West Virginia</option><option value="wisconsin">Wisconsin</option><option value="wyoming">Wyoming</option>';
      } elseif ($formType == "s15") {
          $str = '<option value="">Choose an option</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>';
      } elseif ($formType == "s16") {
          $str = '<option value="">Choose an option</option><option value="AL">AL</option><option value="AK">AK</option><option value="AR">AR</option>	<option value="AZ">AZ</option><option value="CA">CA</option><option value="CO">CO</option><option value="CT">CT</option><option value="DC">DC</option><option value="DE">DE</option><option value="FL">FL</option><option value="GA">GA</option><option value="HI">HI</option><option value="IA">IA</option><option value="ID">ID</option><option value="IL">IL</option><option value="IN">IN</option><option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option><option value="MA">MA</option><option value="MD">MD</option><option value="ME">ME</option><option value="MI">MI</option><option value="MN">MN</option><option value="MO">MO</option><option value="MS">MS</option><option value="MT">MT</option><option value="NC">NC</option><option value="NE">NE</option><option value="NH">NH</option><option value="NJ">NJ</option><option value="NM">NM</option><option value="NV">NV</option><option value="NY">NY</option><option value="ND">ND</option><option value="OH">OH</option><option value="OK">OK</option><option value="OR">OR</option><option value="PA">PA</option><option value="RI">RI</option><option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option><option value="TX">TX</option><option value="UT">UT</option><option value="VT">VT</option><option value="VA">VA</option><option value="WA">WA</option><option value="WI">WI</option><option value="WV">WV</option><option value="WY">WY</option>';
      }
      return $str;
  }
    /** Gets a list of months
     *
     * @param $formType
     *
     * @returns html
     */
  private static function getMonths($formType)
  {
		if ($formType == "a") {
		  $str = '<option value="">Choose an option</option><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option>';
		} else if ($formType == "b") {
		  $str = '<option value="">Choose an option</option><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>';
		} else if ($formType == "c") {
		  $str = '<option value="">Choose an option</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>';
		}
		return $str;
  }




    /** Generate headings, paragraphs, and hidden fields
    *
    * @param $field
    *
    * @returns html
    */

    public static function createContentAndHiddenFields($field) {
      $html = '<div class="form-group field-'.$field['formtype'].'" data-id="'.$field['id'].'">';

      switch ($field['formtype']) {
        case "m02":
        case "m04":
        case "m06":
          $html .= self::formHtag($field);
          break;
        case "m11":
          $html .= self::formHidden($field);
          break;
        default:
          $html .= self::formParagraph($field);
          break;
      }

      // Close .form-group
      $html .= "</div>";

      return $html;
    }

    /** Generate user-editable fields
    *
    * @param $field
    *
    * @returns html
    */

    public static function createEditableFields($field) {
      $html = '<div class="form-group form-group-field field-'.$field['formtype'].'" data-id="'.$field['id'].'">';

      // Enclose checkboxes and radio buttons in a fieldset
      if($field['formtype'] == "s06" || $field['formtype'] == "s08") {
        $html .= "<fieldset>";
      }

      // Don't render fieldLabel for file inputs

      // (Their labels are rendered in formFile,
      // to enable custom styling)
      if($field['formtype'] !== "m13") {
        $html .= self::fieldLabel($field);
      }

      //add aria invalid attributes to required forms
      if (self::isRequired($field)) $field['aria-invalid'] = "false";

      $html .= '<div class="field-wrapper">';

      switch ($field['formtype']) {
        case "s08":
          $html.= self::formRadio($field);
          break;
        case "s06":
          $html.= self::formCheckbox($field);
          break;
        case "i14":
          $html.= self::formTextArea($field);
          break;
        case "s02":
        case "s04":
        case "s14":
        case "s15":
        case "s16":
          $html.= self::formSelect($field);
          break;
        case "m13":
          $html.= self::formFile($field);
          break;
        case "m14":
          $html.= self::formButton($field);
          break;
        default:
          $html.= self::formText($field);
          break;
      }

      // Close .field-wrapper
      $html .= "</div>";

      $html .= self::helpBlock($field);

      if($field['formtype'] == "s06" || $field['formtype'] == "s08") {
        $html .= "</fieldset>";
      }

      // Close .form-group
      $html .= "</div>";

      return $html;
    }

    /** Determine sectionals in the form
    *
    * @param $content
    *
    * @return bool
    */
    public function isSectional($content)
    {
        foreach ($content['data'] as $field) {
            if ($field['formtype'] == "m16") {
                return true;
            }
        }
        return false;
    }

    /** Format form field input attributes
    *
    * @param $id
    * @param $arr
    * @param $checked
    *
    * @return string
    */
  public function getInputSelector($id, $arr, $checked)
  {
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
          case "m16":
            $output = ".form-section[data-id=".$id."]";
            break;
          default:
              $output = "#".$id;
      }
      return $output;
  }

   /** Checks if the formtype is a multi option field ie: radio, checkbox, dropdown
    *
    * @param $formtype
    *
    * @return boolean
    */
  public function isMulti($formtype)
  {
    switch ($formtype) {
      case "s08": //radio
      case "s06": //checkbox
      case "s02": //select
      case "s04": //select
      case "s14": //select state
      case "s15": //select state
      case "s16": //select state
        return true;
      default:
        return false;
    }
  }

  /** Delegates which conditional function to use based on params
    *
    * @param $sel string the selector of the field being evaluated
    * @param $op string the operator of the statement
    * @param $value string/float the value to compare with the value of the field being evaluated
    * @param $isNumber boolean to designate if the value should be interpreted as a string or float
    *
    * @return strings
  */
  public function generateConditionalStatement($sel, $op, $value, $ft) {
    if ($ft === "s06") { //exception case for checkboxes because they have multiple inputs per name
      $output = $this->getCheckboxConditionalStatement($sel, $op, $value);
    } else if ($ft === "d06" || $ft === "d08") {
      $output = $this->getConditionalStatement("jQuery('".$sel."').val()", $this->controllerHelper->getOp($op), $value, true);
    } else {
      $output = $this->getConditionalStatement("jQuery('".$sel."').val()", $this->controllerHelper->getOp($op), $value);
    }
    return $output;
  }

  /** Formats form field conditionals
    *
    * @param $jqString
    * @param $op
    * @param $value
    * @param $isNumber
    *
    * @return strings
  */
  public function getConditionalStatement($jqString, $op, $value, $isNumber = false)
  {
      if (!$op) {
          return "";
      }
      if ($op == "contains") {
          $output = "(".$jqString.").search(/".$value."/i) != -1";
      } elseif ($op == "doesn't contain") {
          $output = "(".$jqString.").search(/".$value."/i) == -1";
      } else {
          if ($isNumber) {
            $output = $jqString." ".$op." ".$value;
          } else {
            $output = $jqString." ".$op." '".$value."'";
          }
      }
      return $output;
  }

    /** Formats checkbox conditionals
    *
    * @param $sel
    * @param $op
    * @param $value
    *
    * @return strings
  */
  public function getCheckboxConditionalStatement($sel, $op, $value)
  {
		$op = str_replace("&amp;apos;", "'", $op); //just in case apostrophe is encoded
		switch ($op) {
			case "":
				$output = "";
				break;
			case "matches":
				$output = "jQuery('".$sel."[value=\"".$value."\"]').length";
				break;
			case "doesn't match":
				$output = "jQuery('".$sel."[value=\"".$value."\"]').length === 0";
				break;
			case "is less than": // will only check the first match, not sure how it would work with multiple
				$output = "jQuery('".$sel."').val() < ".$value;
				break;
			case "is more than": // will only check the first match, not sure how it would work with mutiple
				$output = "jQuery('".$sel."').val() > ".$value;
				break;
			case "contains anything":
				$output = "(jQuery('".$sel."').map(function() {return jQuery(this).val();}).get().join()) != ''";
				break;
			case "is blank":
				$output = "(jQuery('".$sel."').map(function() {return jQuery(this).val();}).get().join()) == ''";
				break;
			case "contains":
				$output = "(jQuery('".$sel."').map(function() {return jQuery(this).val();}).get().join()).search(/".$value."/i) != -1";
				break;
			case "doesn't contain":
				$output = "(jQuery('".$sel."').map(function() {return jQuery(this).val();}).get().join()).search(/".$value."/i) == -1";
				break;
			default:
				$output = $sel." ".$op." '".$value."'";
				break;
		}
		return $output;
  }
}