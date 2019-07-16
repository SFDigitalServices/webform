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

     /**
     * Gets a list of states
     *
     * @returns html
     */
	private static function getStates($formType) {
        if ($formType == "s14") {
            $str = '<option value="">Select</option><option value="alabama">Alabama</option><option value="alaska">Alaska</option><option value="arizona">Arizona</option><option value="arkansas">Arkansas</option><option value="california">California</option><option value="colorado">Colorado</option><option value="connecticut">Connecticut</option><option value="delaware">Delaware</option><option value="district-of-columbia">District Of Columbia</option><option value="florida">Florida</option><option value="georgia">Georgia</option><option value="hawaii">Hawaii</option><option value="idaho">Idaho</option><option value="illinois">Illinois</option><option value="indiana">Indiana</option><option value="iowa">Iowa</option><option value="kansas">Kansas</option><option value="kentucky">Kentucky</option><option value="louisiana">Louisiana</option><option value="maine">Maine</option><option value="maryland">Maryland</option><option value="massachusetts">Massachusetts</option><option value="michigan">Michigan</option><option value="minnesota">Minnesota</option><option value="mississippi">Mississippi</option><option value="missouri">Missouri</option><option value="montana">Montana</option><option value="nebraska">Nebraska</option><option value="nevada">Nevada</option><option value="new-hampshire">New Hampshire</option><option value="new-jersey">New Jersey</option><option value="new-mexico">New Mexico</option><option value="new-york">New York</option><option value="north-carolina">North Carolina</option><option value="north-dakota">North Dakota</option><option value="ohio">Ohio</option><option value="oklahoma">Oklahoma</option><option value="oregon">Oregon</option><option value="pennsylvania">Pennsylvania</option><option value="rhode-island">Rhode Island</option><option value="south-carolina">South Carolina</option><option value="south-dakota">South Dakota</option><option value="tennessee">Tennessee</option><option value="texas">Texas</option><option value="utah">Utah</option><option value="vermont">Vermont</option><option value="virginia">Virginia</option><option value="washington">Washington</option><option value="west-virginia">West Virginia</option><option value="wisconsin">Wisconsin</option><option value="wyoming">Wyoming</option>';
        } elseif ($formType == "s15") {
            $str = '<option value="">Select</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District Of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option>';
        } elseif ($formType == "s16") {
            $str = '<option value="">Select</option><option value="AL">AL</option><option value="AK">AK</option><option value="AR">AR</option>	<option value="AZ">AZ</option><option value="CA">CA</option><option value="CO">CO</option><option value="CT">CT</option><option value="DC">DC</option><option value="DE">DE</option><option value="FL">FL</option><option value="GA">GA</option><option value="HI">HI</option><option value="IA">IA</option><option value="ID">ID</option><option value="IL">IL</option><option value="IN">IN</option><option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option><option value="MA">MA</option><option value="MD">MD</option><option value="ME">ME</option><option value="MI">MI</option><option value="MN">MN</option><option value="MO">MO</option><option value="MS">MS</option><option value="MT">MT</option><option value="NC">NC</option><option value="NE">NE</option><option value="NH">NH</option><option value="NJ">NJ</option><option value="NM">NM</option><option value="NV">NV</option><option value="NY">NY</option><option value="ND">ND</option><option value="OH">OH</option><option value="OK">OK</option><option value="OR">OR</option><option value="PA">PA</option><option value="RI">RI</option><option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option><option value="TX">TX</option><option value="UT">UT</option><option value="VT">VT</option><option value="VA">VA</option><option value="WA">WA</option><option value="WI">WI</option><option value="WV">WV</option><option value="WY">WY</option>';
        }
        return $str;
    }
     /**
     * Gets a list of months
     *
     * @returns html
     */
	private static function getMonths($formType) {
		if ($formType == "a") {
		  $str = '<option value="">Select</option><option value="january">January</option><option value="february">February</option><option value="march">March</option><option value="april">April</option><option value="may">May</option><option value="june">June</option><option value="july">July</option><option value="august">August</option><option value="september">September</option><option value="october">October</option><option value="november">November</option><option value="december">December</option>';
		} else if ($formType == "b") {
		  $str = '<option value="">Select</option><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>';
		} else if ($formType == "c") {
		  $str = '<option value="">Select</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>';
		}
		return $str;
  }

}
