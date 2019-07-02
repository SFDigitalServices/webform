<?php
namespace App\Helpers;

use Log;
use App\Helpers\ListHelper;

class HTMLHelper
{
    /**
    * Generate Radio input element
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
    /**
    * Generate Checkbox input element
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
    /**
     * Generate Text element
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
    /**
     * Generate TextArea element
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
    /**
    * Generate Select element
    *
    * @returns html
    */
    public static function formSelect($field)
    {
        $attributes = self::setAttributes($field);
        $html = '<select'. $attributes .'>';

        // need to check for formtypes: s02, s04, s14, s15, s16
        if ($field['formtype'] == "s14" || $field['formtype'] == "s15" || $field['formtype'] == "s16") {
            $html .= ListHelper::getStates($field['formtype']);
        } elseif (isset($field['option'])) {
            foreach ($field['option'] as $option) {
                $html .= '<option value="'.$option.'">'.$option.'</option>';
            }
        }
		
        $html .= "</select>";
        return $html;
    }

    /**
     * Generate Prepeded element
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
	
    /**
    * Generate Button element
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
    /**
    * Generate paragraph element
    *
    * @returns html
    */
    public static function formParagraph($field)
    {
        // type and formtype are not valid attributes for accessibility.
        $attributes = self::setAttributes($field);

		if ($field['formtype'] == "m08") {
			$field_value = isset($field['textarea']) ? str_replace("\n", "<br/>", $field['textarea']) : "";
		} else if ($field['formtype'] == "m10") {
			$field_value = isset($field['codearea']) ? str_replace("\n", "<br/>", $field['codearea']) : ""; //todo unescape code?
		} else {
			$field_value = ''; //should not happen
		}
		
        $html = '<p'. $attributes .'>'.$field_value.'</p>';
        return $html;
    }
    /**
    * Generate H tag element
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

    /**
     * Generate Section element
     *
     * @returns html
     */
    public static function formSection($field)
    {
        $html = '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id="'.$field['id'].'">'.$field['label'].'</div><div class="form-section" data-id="'.$field['id'].'">';

        return $html;
    }
    /**
    * Generate hidden element
    *
    * @returns html
    */
    public static function formHidden($field)
    {
		//this one probably needs value!
		$value = isset($field['value']) ? ' value="'.$field['value'].'"' : "";
        $attrbiutes = self::setAttributes($field);

        return '<input'.$attrbiutes.$value.'/>';
    }

    /**
     * Constructs label
     *
     * @returns html
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
    /**
     * Constructs help text block
     *
     * @returns html
     */
    public static function helpBlock($field)
    {
        $str = array_key_exists('help', $field) ? '<p class="help-block with-errors">'.$field['help'].'</p>' : '<p class="help-block with-errors"></p>';
        $str .= '</div></div>';
        return $str;
    }

	
    /**
     * Strips field attributes by formType
     *
     * @returns field array
     */
    private static function stripAttributesByFormType($field) {
		switch ($field['formtype']) {
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
	
    /**
     * Process fields by type, adds steps to numbers, and strips invalid validators
     *
     * @returns field array
     */
    private static function processFieldsByType($field) {
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
			if ($field['type'] != "regex") unset($field['regex']);
			if ($field['type'] != "match") unset($field['match']);
		} else {
			unset($field['min']);
			unset($field['max']);
			unset($field['regex']);
			unset($field['match']);
		}
		return $field;
	}
	
    /**
     * Constructs field attributes
     *
     * @returns attribute string
     */
    private static function setAttributes($field)
    {
		$html = '';
		
        //unset unused attributes
        unset($field['label'], $field['help']);
        unset($field['conditions'], $field['calculations']);
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
            } else if ($key == 'type' && ($value == 'regex' || $value == 'match')) {
                $html .= ' type="text"';
            } else if ($key == 'regex') {
                $html .= ' pattern="'.$value.'"';
            } else if ($key == "match") {
              $html .= ' data-match="#'.$value.'"';
            } else if ($key == "required") {
				if ($value == "true") $html .= ' required';
            } else {
                $html .= ' '. $key .'="'. $value . '"';
            }
        }
		
		return $html;
    }
}
