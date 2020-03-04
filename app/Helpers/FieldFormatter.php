<?php
namespace App\Helpers;

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
        //$html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        $html = array($name => $value);
        return $html;
    }
    /**
      * Formats file field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatFile($name, $value)
    {
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
    public static function formatNumber($name, $value)
    {
      $html = array($name => $value);
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
      $html = array($name => $value);
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