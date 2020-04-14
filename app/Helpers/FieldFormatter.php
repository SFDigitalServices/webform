<?php
namespace App\Helpers;

use Log;

class FieldFormatter
{
    /**
    * Formats email field
    *
    * @param $name
    * @param $value
    *
    * @return array
    */
    public static function formatEmail($name, $value)
    {
        $value = '<a href="mailto:'.$value.'">'.$value.'</a>';
        $html = array($name => $value);
        return $html;
    }

    /**
      * Formats phone field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatPhone($name, $value)
    {
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats url field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatURL($name, $value)
    {
        $value = '<a href="'.$value.'" target="_blank" >'.$value.'</a>';
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats dropdowns/radio/checkbox field
      *
      * @param $name
      * @param $value
      * @param $host
      *
      * @return array
    */
    public static function formatOptions($name, $value, $host)
    {
        $checklist = '';
        // need to move this to the design system
        //$checkmark = '<img src="'.$host.'/images/email-checkbox.jpg" height="25px" width="25px" />';
        $checkmark = '';
        if (is_array($value)) {
            $count = 0;
            foreach ($value as $option) {
                if ($count > 0) {
                    $checklist .= '<div>' . $checkmark . " " . $option . '</div>';
                } else {
                    $checklist .= $checkmark . " " . $option;
                }
                $count++;
            }
        } else {
            $checklist = $checkmark . " " . $value;
        }
        $value = $checklist;
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats file field
      *
      * @param $name
      * @param $value
      * @param $file
      * @param $type
      *
      * @return HTML
    */
    public static function formatFile($name, $value, $file = null, $isInternal = false)
    {
        // fall back if ajax uploader is not supported
        $unit = ["B", "KB", "MB", "GB"];
        if ($file != null) {
            $exp = floor(log($file->getSize(), 1024)) | 0;
            $size = round($file->getSize() / (pow(1024, $exp)), 2).$unit[$exp];
            $value = $file->getClientOriginalName() .": (". $size .")";
        } else { // get file info from managed_file
            $dataStoreHelper = new DataStoreHelper();
            $file = $dataStoreHelper->getManagedFile($value);
            $exp = floor(log($file->filesize, 1024)) | 0;
            $size = round($file->filesize / (pow(1024, $exp)), 2).$unit[$exp];
            if ($isInternal) {
                $value = '<a href="'.$file->url.'" target=_blank>' . $file->filename . '</a>';
            }
            else{
              $value = $file->filename . " (" . $size . ")";
            }
        }
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats number field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatNumber($name, $value, $unit)
    {
        $html = array($name => $value . " ". $unit);
        return $html;
    }
    /**
      * Formats price field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatPrice($name, $value)
    {
        $html = array($name => '$'. $value.'');
        return $html;
    }
    /**
      * Formats date field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatDate($name, $value)
    {
        $value = date("M j, Y", strtotime($value));
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats time field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatTime($name, $value)
    {
        $value = date("g:i a", strtotime($value));
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats phone field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatTextArea($name, $value)
    {
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats phone field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatText($name, $value)
    {
        $html = array($name => $value);
        return $html;
    }
}
