<?php
namespace App\Helpers;

use Log;
use App\Helpers\ListHelper;

class HTMLHelper
{
    /**
    * Generate Radio button element
    *
    * @returns html
    */

    public static function formRadio($field)
    {
        $html = "";
        $value = "";
        $formtype = isset($field['formtype']) ?  $field['formtype']: "";
        $required = (isset($field['required']) && $field['required'] == 'true') ? 'required ': "";
        $name = $field['id'];

        if (array_key_exists('value', $field)) {
            $value = $field['value'];
        }
        //construct radio inputs, one or more
        if (array_key_exists('radios', $field)) {
            foreach ($field['radios'] as $radio) {
                if (strcasecmp($radio, $value) == 0) {
                    $isCheck = "checked ";
                } else {
                    $isCheck = "";
                }
                $id = str_replace(' ', '_', $radio);
                $html .= '<div class="rb-input-group"><input type="radio" id="'.$id.'" name="'.$name.'" value="'.$radio.'" formtype="'. $formtype . '" '. $required .$isCheck. '><label for="'.$id.'" class="radio">'.$radio.'</label></div>';
            }
        }
        return $html;
    }
    /**
    * Generate Checkbox button element
    *
    * @returns html
    */
    public static function formCheckbox($field)
    {
        $html = "";
        $isCheck = "";
        $value = "";
        $name = "";
        //get attributes
        $formType = $field['formtype'];
        $required = (isset($field['required']) && $field['required'] == 'true') ? 'required ': "";
        if (array_key_exists('name', $field) && ! empty($field['name'])) {
            $name = $field['name']."[]";
        }
        if (array_key_exists('value', $field)) {
            $value = $field['value'];
        }
        //construct checkbox inputs, one or more
        if (array_key_exists('checkboxes', $field)) {
            foreach ($field['checkboxes'] as $checkbox) {
                $id = str_replace(' ', '_', $checkbox);
                if (strcasecmp($checkbox, $value) == 0) {
                    $isCheck = "checked ";
                } else {
                    $isCheck = "";
                }

                $html .= '<div class="cb-input-group"><input type="checkbox" id="'.$id.'" value="'.$checkbox.'" name="'.$name .'" '.$required.$isCheck .'><label for="'. $id .'" class="checkbox">'.$checkbox.'</label></div>';
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
        $html = "<input ";
        //unset unused attributes
        unset($field['label'], $field['help']);
        unset($field['conditions']);
        unset($field['calculations']);
        foreach ($field as $key => $value) {
            if ($key == 'regex') {
                $html .= ' pattern="'.$value.'" ';
            } else if ($key == "match") {
              $html .= ' data-match="#'.$value.'" ';
            } else if ($key == "required") {
				if ($value == "true") $html .= 'required ';
            } else {
                $html .= ' '. $key .'="'. $value . '"';
            }
        }
        if ($field['formtype'] == 'number') {
            $html .= 'step="any"';
        }
        $html .= "/>";
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
        // need to check for formtypes: s02, s04, s14, s15, s16
        $html = '<select'. $attributes .'>';
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
    * Generate Button element
    *
    * @returns html
    */
    public static function formButton($field)
    {
        $attributes = self::setAttributes($field);

        $html = "<button".$attributes .">" . $field['button'] ."</button>";
        return $html;
    }
    /**
    * Generate hidden element
    *
    * @returns html
    */
    public static function formParagraph($field)
    {
        // type and formtype are not valid attributes for accessibility.
        unset($field['type']);
        unset($field['formtype']);
        $attributes = self::setAttributes($field);

        $field_value = isset($field['textarea']) ? $field['textarea'] : $field['codearea'];
        $field_value = str_replace("\n", "<br/>", $field_value);
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
        $formtype = $field['formtype'];
        unset($field['type']);
        unset($field['formtype']);
        $attributes = self::setAttributes($field);

        $textarea = isset($field['textarea']) ? $field['textarea'] : "";
        $textarea = str_replace("\n", "<br/>", $textarea);
        switch ($formtype) {
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
    * Generate Paragrap element
    *
    * @returns html
    */
    public static function formHidden($field)
    {
        $attrbiutes = self::setAttributes($field);

        return '<input'.$attrbiutes .'/>';
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
     * Constructs field attributes
     *
     * @returns attribute string
     */
    private static function setAttributes($field)
    {
        //unset unused attributes such as conditions and calculations
        unset($field['conditions']);
        unset($field['calculations']);

        $formtype = isset($field['formtype']) ? ' formtype="' . $field['formtype'] . '"': "";
        $id = isset($field['id']) ? ' id="' . $field['id'] . '"': "";
        $name = isset($field['name']) ? ' name="' . $field['name'] .'"': "";
        $type = isset($field['type']) ? ' type="' .$field['type']. '"': "";
        $class = isset($field['class']) ? ' class="' . $field['class'] : "";

        // append color class to $class
        if (isset($field['color'])) {
            if (isset($field['class'])) {
                $class .= ' ' . $field['color'] . '"';
            } else {
                $class = ' class="' . $field['color'] . '"';
            }
        } elseif ($class != '') {
            $class .= '"';
        }
        //$textarea = isset($field['textarea']) ? $field['textarea']: "";
        $required = (isset($field['required']) && $field['required'] == 'true') ? " required": "";
        $value = isset($field['value']) ? ' value="' . $field['value'] . '"': "";
        $match = isset($field['match']) ? ' data-match="#' . $field['value'] . '"': "";

        $attributes = $id.$name.$type.$formtype.$class.$value.$required;
        if ($attributes != "") {
            $attributes = " " . $attributes . " ";
        }
        return $attributes;
    }
}
