<?php
use App\Helpers\FieldFormatter;
use Log;

class FieldFormatterTest extends \Codeception\Test\Unit
{
  protected function _before()
  {
      $this->formatTester = new FieldFormatter();
  }

  public function testFormatEmail(){
    $name = "Email";
    $value = "test@sf.gov";
    $actual = FieldFormatter::formatEmail($name, $value);
    $expected = array($name => '<a href="mailto:test@sf.gov">test@sf.gov</a>');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }

  public function testFormatPhone(){
    $name = "Phone";
    $value = "(510) 555-5555";
    $actual = FieldFormatter::formatPhone($name, $value);
    $expected = array($name => '(510) 555-5555');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  public function testFormatURL(){
    $name = "URL";
    $value = "http://google.com";
    $actual = FieldFormatter::formatURL($name, $value);
    $expected = array($name => '<a href="http://google.com" target="_blank" >http://google.com</a>');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  public function testFormatOptions(){
    $name = "Select";
    $host = "https://formbuilder-sf-staging.herokuapp.com/";
    $value = "Beef";
    $actual = FieldFormatter::formatOptions($name, $value, $host);
    $expected = array($name => '<img src="https://formbuilder-sf-staging.herokuapp.com//images/email-checkbox.jpg" height="25px" width="25px" /> Beef');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }

  /* not sure how to test File upload yet
  public function testFormatFile(){

  }
  */
  public function testFormatNumber(){
    $name = "Number";
    $value = "12";
    $unit = "months";
    $actual = FieldFormatter::formatNumber($name, $value, $unit);
    $expected = array($name => '12 months');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  public function testFormatPrice(){
    $name = "Price";
    $value = "399";
    $actual = FieldFormatter::formatPrice($name, $value);
    $expected = array($name => '$399');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  public function testFormatDate(){
    $name = "Date";
    $value = "2020-03-04";
    $actual = FieldFormatter::formatDate($name, $value);
    $expected = array($name => 'March 4, 2020');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  public function testFormatTime(){
    $name = "Time";
    $value = "22:00";
    $actual = FieldFormatter::formatTime($name, $value);
    $expected = array($name => '10:00 pm');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  public function testFormatTextArea(){
    $name = "TextArea";
    $value = "this is a text area";
    $actual = FieldFormatter::formatTextArea($name, $value);
    $expected = array($name => 'this is a text area');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  public function testFormatText(){
    $name = "Text";
    $value = "this is a text";
    $actual = FieldFormatter::formatText($name, $value);
    $expected = array($name => 'this is a text');
    $this->assertTrue($this->arrays_are_similar($expected, $actual));
  }
  /**
   * Determine if two associative arrays are similar
   *
   * Both arrays must have the same indexes with identical values
   * without respect to key ordering
   *
   * @param array $a
   * @param array $b
   * @return bool
   */
  private function arrays_are_similar($a, $b) {
      // if the indexes don't match, return immediately
      if (count(array_diff_assoc($a, $b))) {
          return false;
      }
      // we know that the indexes, but maybe not values, match.
      // compare the values between the two arrays
      foreach ($a as $k => $v) {
          if ($v !== $b[$k]) {
              return false;
          }
      }
      // we have identical indexes, and no unequal values
      return true;
  }
}