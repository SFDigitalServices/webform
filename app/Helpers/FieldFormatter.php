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
    * @return HTML
    */
    public static function formatEmail($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }

    /**
      * Formats phone field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatPhone($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats url field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatURL($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats dropdowns/radio/checkbox field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatOptions($name, $value)
    {
        //$html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        $html = "";
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
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats number field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatNumber($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats price field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatPrice($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats date field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatDate($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats time field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatTime($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats phone field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatTextArea($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
    /**
      * Formats phone field
      *
      * @param $name
      * @param $value
      *
      * @return HTML
    */
    public static function formatText($name, $value)
    {
        $html = '<div class="field-value"><label>'.$name.'</label><span>'.$value.'</span></div>';
        return $html;
    }
}