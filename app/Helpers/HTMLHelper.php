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

        $form_div = '<form id="SFDSWFB_forms_'.$formid.'" class="form-horizontal" action="'.$content['settings']['action'].'" method="'.$content['settings']['method'].'" '.$formEncoding.'><fieldset><div id="SFDSWFB-legend"><legend>'.$content['settings']['name'].'</legend></div>';

        $form_container = '';
        $sections = [];

        //if this form is a csv transaction, add form_id.
        if( isset($content['settings']['backend']) ) {
            $form_container .= '<input type="hidden" name="form_id" value="'.$form['id'].'"/>';
        }
        // looping through all form fields.
        foreach ($content['data'] as $field) {
            $field_header = '<div class="form-group" data-id="'.$field['id'].'">' . $this->fieldLabel($field);

            switch ($field['formtype']) {
												case "s08": $form_container .= $field_header . $this->formRadio($field). $this->helpBlock($field);
														break;
                        case "s06": $form_container .= $field_header . $this->formCheckbox($field) . $this->helpBlock($field);
                            break;
                        case "i14": $form_container .= $field_header . $this->formTextArea($field) . $this->helpBlock($field);
                            break;
                        case "s02":
                        case "s04":
                        case "s14":
                        case "s15":
                        case "s16":
                            $form_container .= $field_header . $this->formSelect($field) . $this->helpBlock($field);
                            break;
                        case "m02":
                        case "m04":
                        case "m06": $form_container .= $field_header . $this->formHtag($field) . $this->helpBlock($field);
                            break;
                        case "m08":
                        case "m10":
                            $form_container .= $field_header . $this->formParagraph($field) .$this->helpBlock($field);
                            break;
                        case "m14":
							              if (empty($sections)) $form_container .= $field_header . $this->formButton($field) . $this->helpBlock($field);
                            break;
                        case "m16": $form_container .= $this->formSection($field); $sections[] = $field;
                            break;
                        case "m11": $form_container .= $this->formHidden($field);
                            break;
                        default: $form_container .= $field_header . $this->formText($field) . $this->helpBlock($field);
                            break;
            }
            // append help block
            //$form_container .= $this->helpBlock($field);
        } //end of foreach


        // Form Sections
        if (!empty($sections)) {
            $section1 = isset($content['settings']['section1']) ? $content['settings']['section1'] : $content['settings']['name'];
            $nav = '<div class="form-section-nav"><a class="active" href="javascript:void(0)">'.$section1.'</a>';
            foreach ($sections as $idx => $section) {
                $active = $idx === "0" ? ' class="active"' : '';
                $nav .= '<a'.$active.' href="javascript:void(0)">'.$section['label'].'</a>';
            }
            $nav .= '</div>';
            $form_wraper_top = '<div class="sections-container"><div class="form-section-header active">'.$section1.'</div><div class="form-section active">';
            $form_wrapper_bottom = '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><button id="submit" class="btn btn-lg submit">Submit</button></div></div></div>';
            $form_container = $nav. $form_div. $form_wraper_top. $form_container. $form_wrapper_bottom;
        } else {
            $form_container = $form_div. $form_container;
        }
        $form_end = "";
        if (isset($content['settings']['backend']) && $content['settings']['backend'] === 'csv') {
          $form_end = '<div class="form-group" data-id="saveForLater"><label for="saveForLater" class="control-label"></label><div class="field-wrapper"><a href="javascript:submitPartial('.$formid.')" >Save For Later</a></div></div>';
        }
        $form_end .= '</fieldset></form>';
        // clean up line breaks, otherwise embedjs will fail
        return preg_replace("/\r|\n/", "", $form_container . $form_end);
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
		"'//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.1/validator.min.js', " .
		"'//" . $host . "/assets/js/error-msgs.js'" .
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
              $js .= $calcFunc . ";";
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
				  if ($formtypes[$condition['id']] == "s06") { //exception case for checkboxes because they have multiple inputs per name
					$conditionSts[] = $this->getCheckboxConditionalStatement($this->getInputSelector($condition['id'], $formtypes, true), $condition['op'], $condition['val']);
				  } else {
					$conditionSts[] = $this->getConditionalStatement("jQuery('".$this->getInputSelector($condition['id'], $formtypes, true)."').val()", $this->controllerHelper->getOp($condition['op']), $condition['val']);
				  }
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
      // check to see if this is a retrieval
      $populateJS = '';
      if($referer !== ''){
        $query = parse_url($referer, PHP_URL_QUERY);
        parse_str($query, $output);
        if(isset($output['draft'])){
          $draft = $output['draft'];
          $form_id = $output['form_id'];
          $data = $this->dataStoreHelper->retrieveFormDraft($form_id, $draft);
          $populateJS = "var draftData = ". json_encode($data) .";";
        }
      }
      $js .= "};script.src = '//".$host."/assets/js/embed.js';var s = document.createElement('script');s.setAttribute('type', 'text/javascript'); s.text='$populateJS';document.head.append(s);document.head.appendChild(script);"; //end ready
      return $js;
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
                $html .= '<div class="rb-input-group"><input type="radio" id="'.$id.'" value="'.$option.'"'.$attributes.'/><label for="'.$id.'" class="radio">'.$option.'</label></div>';
            }
        }
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
        //name needs to be an array
        $field['name'] = isset($field['name']) && $field['name'] != "" ? $field['name'] . "[]" : "";
        //id is set per option
        $field_id = isset($field['id']) ? $field['id'] : "";
        unset($field['id']);
        //convert checkboxes to options and remove them from fields
        $options = isset($field['checkboxes']) ? $field['checkboxes'] : array();
        unset($field['checkboxes']);
        //get attributes
        $attributes = self::setAttributes($field);
        //construct checkbox inputs, one or more
        if (!empty($options)) {
            foreach ($options as $option) {
                $id = str_replace(' ', '_', $field_id . '_' . $option);
                $html .= '<div class="cb-input-group"><input type="checkbox" id="'.$id.'" value="'.$option.'"'.$attributes.'/><label for="'. $id .'" class="checkbox">'.$option.'</label></div>';
            }
        }
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
            foreach ($field['option'] as $option) {
                $html .= '<option value="'.$option.'">'.$option.'</option>';
            }
        }

        $html .= "</select>";
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
        $html = $prepended . '<input' . $attributes . '/><label for="' . $field['id'] . '">' . $field['label'] . '</label>';
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

        $html = "<button".$attributes .">" . $button ."</button>";
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
            $field_value = isset($field['codearea']) ? str_replace("\n", "<br/>", html_entity_decode(html_entity_decode($field['codearea']))) : "";
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

   /** Generate Section element
     *
     * @param $field
     *
     * @return html
     */
    public static function formSection($field)
    {
        $html = '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id="'.$field['id'].'">'.$field['label'].'</div><div class="form-section" data-id="'.$field['id'].'">';

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
        $attrbiutes = self::setAttributes($field);

        return '<input'.$attrbiutes.$value.'/>';
    }

  /** Constructs label
    *
     * @param $field
     *
     * @return html
     */
    public static function fieldLabel($field)
    {
        $label_for = $field['id'];
        if (! $label_for) {
            $label_for = $field['name'];
        }

        $html = ($field['formtype'] == "s06") ? '<legend class="control-label">':  '<label for="'.$label_for.'" class="control-label">';
        $html .= isset($field['label']) ? $field['label'] : "";
        if (array_key_exists('required', $field)) {
            if (! $field['required'] == "true") {
                $html .= ' <span class="optional">(optional)</span>';
            }
        }
        $html .= ($field['formtype'] == "s06") ? '</legend><div class="field-legend">' : '</label><div class="field-wrapper">';
        return $html;
    }

   /** Constructs help text block
     *
     * @param $field
     *
     * @return html
     */
    public static function helpBlock($field)
    {
        $str = array_key_exists('help', $field) ? '<p class="help-block with-errors">'.$field['help'].'</p>' : '<p class="help-block with-errors"></p>';
        $str .= '</div></div>';
        return $str;
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
			case 'm04': //h2
			case 'm06': //h3
			case 'm08': //p
			case 'm10': //p html
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
            if ($value == '') {
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
          $str = '<option value="">Select</option><option value="alabama">Alabama</option><option value="alaska">Alaska</option><option value="arizona">Arizona</option><option value="arkansas">Arkansas</option><option value="california">California</option><option value="colorado">Colorado</option><option value="connecticut">Connecticut</option><option value="delaware">Delaware</option><option value="district-of-columbia">District Of Columbia</option><option value="florida">Florida</option><option value="georgia">Georgia</option><option value="hawaii">Hawaii</option><option value="idaho">Idaho</option><option value="illinois">Illinois</option><option value="indiana">Indiana</option><option value="iowa">Iowa</option><option value="kansas">Kansas</option><option value="kentucky">Kentucky</option><option value="louisiana">Louisiana</option><option value="maine">Maine</option><option value="maryland">Maryland</option><option value="massachusetts">Massachusetts</option><option value="michigan">Michigan</option><option value="minnesota">Minnesota</option><option value="mississippi">Mississippi</option><option value="missouri">Missouri</option><option value="montana">Montana</option><option value="nebraska">Nebraska</option><option value="nevada">Nevada</option><option value="new-hampshire">New Hampshire</option><option value="new-jersey">New Jersey</option><option value="new-mexico">New Mexico</option><option value="new-york">New York</option><option value="north-carolina">North Carolina</option><option value="north-dakota">North Dakota</option><option value="ohio">Ohio</option><option value="oklahoma">Oklahoma</option><option value="oregon">Oregon</option><option value="pennsylvania">Pennsylvania</option><option value="rhode-island">Rhode Island</option><option value="south-carolina">South Carolina</option><option value="south-dakota">South Dakota</option><option value="tennessee">Tennessee</option><option value="texas">Texas</option><option value="utah">Utah</option><option value="vermont">Vermont</option><option value="virginia">Virginia</option><option value="washington">Washington</option><option value="west-virginia">West Virginia</option><option value="wisconsin">Wisconsin</option><option value="wyoming">Wyoming</option>';
      } elseif ($formType == "s15") {
          $str = '<option value="">Select</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>';
      } elseif ($formType == "s16") {
          $str = '<option value="">Select</option><option value="AL">AL</option><option value="AK">AK</option><option value="AR">AR</option>	<option value="AZ">AZ</option><option value="CA">CA</option><option value="CO">CO</option><option value="CT">CT</option><option value="DC">DC</option><option value="DE">DE</option><option value="FL">FL</option><option value="GA">GA</option><option value="HI">HI</option><option value="IA">IA</option><option value="ID">ID</option><option value="IL">IL</option><option value="IN">IN</option><option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option><option value="MA">MA</option><option value="MD">MD</option><option value="ME">ME</option><option value="MI">MI</option><option value="MN">MN</option><option value="MO">MO</option><option value="MS">MS</option><option value="MT">MT</option><option value="NC">NC</option><option value="NE">NE</option><option value="NH">NH</option><option value="NJ">NJ</option><option value="NM">NM</option><option value="NV">NV</option><option value="NY">NY</option><option value="ND">ND</option><option value="OH">OH</option><option value="OK">OK</option><option value="OR">OR</option><option value="PA">PA</option><option value="RI">RI</option><option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option><option value="TX">TX</option><option value="UT">UT</option><option value="VT">VT</option><option value="VA">VA</option><option value="WA">WA</option><option value="WI">WI</option><option value="WV">WV</option><option value="WY">WY</option>';
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
		  $str = '<option value="">Select</option><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option>';
		} else if ($formType == "b") {
		  $str = '<option value="">Select</option><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>';
		} else if ($formType == "c") {
		  $str = '<option value="">Select</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>';
		}
		return $str;
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
          default:
              $output = "#".$id;
      }
      return $output;
  }

    /** Formats form field conditionals
    *
    * @param $value1
    * @param $op
    * @param $value2
    *
    * @return strings
  */
  public function getConditionalStatement($value1, $op, $value2)
  {
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

    /** Formats checkbox conditionals
    *
    * @param $value1
    * @param $op
    * @param $value2
    *
    * @return strings
  */
  public function getCheckboxConditionalStatement($value1, $op, $value2)
  {
		$op = str_replace("&amp;apos;", "'", $op); //just in case apostrophe is encoded
		switch ($op) {
			case "":
				$output = "";
				break;
			case "matches":
				$output = "jQuery('".$value1."[value=".$value2."]').length";
				break;
			case "doesn't match":
				$output = "jQuery('".$value1."[value=".$value2."]').length === 0";
				break;
			case "is less than": // will only check the first match, not sure how it would work with multiple
				$output = "jQuery('".$value1."').val() < ".$value2;
				break;
			case "is more than": // will only check the first match, not sure how it would work with mutiple
				$output = "jQuery('".$value1."').val() > ".$value2;
				break;
			case "contains anything":
				$output = "(jQuery('".$value1."').map(function() {return jQuery(this).val();}).get().join()) != ''";
				break;
			case "is blank":
				$output = "(jQuery('".$value1."').map(function() {return jQuery(this).val();}).get().join()) == ''";
				break;
			case "contains":
				$output = "(jQuery('".$value1."').map(function() {return jQuery(this).val();}).get().join()).search(/".$value2."/i) != -1";
				break;
			case "doesn't contain":
				$output = "(jQuery('".$value1."').map(function() {return jQuery(this).val();}).get().join()).search(/".$value2."/i) == -1";
				break;
			default:
				$output = $value1." ".$op." '".$value2."'";
				break;
		}
		return $output;
  }
}
