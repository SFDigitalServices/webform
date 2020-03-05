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
        return $html;
    }
    /**
      * Formats dropdowns/radio/checkbox field
      *
      * @param $name
      * @param $value
      *
      * @return array
    */
    public static function formatOptions($name, $value)
    {
        $checklist = '';
        $checkmark = '<img src="https://svgsilh.com/svg/40319.svg" height="25px" width="25px" />';
        if(is_array($value)){
          foreach($value as $option){
            $checklist .= $checkmark . " " . $option;
          }
        }
        else{
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
      * @param $file
      * @param $value
      *
      * @return HTML
    */
    public static function formatFile($name, $file, $value)
    {
        $unit = ["B", "KB", "MB", "GB"];
        $exp = floor(log($file->getSize(), 1024)) | 0;
        $size = round($file->getSize() / (pow(1024, $exp)), 2).$unit[$exp];
        $value = $file->getClientOriginalName() .": (". $size .")";
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
        $value = date("F j, Y", strtotime($value));
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