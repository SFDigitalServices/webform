<?php
namespace App\Helpers;
use Log;

// All helper functions should belong here, the controller should not contain any helper/utilty functions
class ControllerHelper
{
    public function parseOptionValues($content, $op = '')
    {
        if(isset($content['settings']))
            $ret['settings'] = $content['settings'];
        $ret['data'] = array();

        foreach ($content['data'] as $field) {
            if (array_key_exists('option', $field)) {
                if(!is_array($field['option']))
                    $field['option'] = explode("\n", $field['option']);
                if(strcmp($op, 'json') == 0)
                    $field['option'] = json_encode($field['option']);
            } elseif (array_key_exists('checkboxes', $field) ) {
                if(!is_array($field['checkboxes']))
                    $field['checkboxes'] = explode("\n", $field['checkboxes']);
                if(strcmp($op, 'json') == 0)
                    $field['checkboxes'] = json_encode($field['checkboxes']);
            } elseif (array_key_exists('radios', $field) ) {
                if(!is_array($field['radios']))
                    $field['radios'] = explode("\n", $field['radios']);
                if(strcmp($op, 'json') == 0)
                    $field['radios'] = json_encode($field['radios']);
            }
            $ret['data'][] = $field;
        }
        return $ret;
    }

    /*
    * @newFormData - form content data being submitted through saveForm
    * @originalFormData - form's original content data, passed through saveForm
    *
    * @retrun - array of fields that doesn't match up.
    */
    public function getFormColumnsToUpdate($newFormData, $originalFormData){
        $updates = array();
        $newFormData = $this->parseOptionValues($newFormData, 'json');
        if (!empty($originalFormData['data'])) {
            $originalFormData = $this->parseOptionValues($originalFormData);
            $originalFormData = $this->parseOptionValues($originalFormData, 'json');
            foreach ($newFormData['data'] as $key => $value) {
                foreach ($originalFormData['data'] as $originalKey => $originalValue) {
                    if (strcmp($value['name'], $originalValue['name']) == 0) {
                        $diff = array_diff($value, $originalValue);
                        if (count($diff) != 0) { // key and value matches
                        $updates['update'] = $value; // key found, value doesn't match, this is an update.
                        }
                        unset($originalFormData['data'][$originalKey]);
                        unset($newFormData['data'][$key]);
                        break;
                    }
                }
            }
        }
        //TODO: upgrade to bulk delete/add
        if( $originalFormData['data'] && count($originalFormData['data']) > 0){
            $updates['remove'] = reset($originalFormData['data']);
        }
        if($newFormData['data'] && count($newFormData['data']) > 0){
            $updates['add'] = reset($newFormData['data']);
        }

        //Log::info(print_r($updates,1));
        return $updates;
    }
}