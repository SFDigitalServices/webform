<?php
use App\Helpers\ControllerHelper;
use Log;

class ControllerHelperTest extends \Codeception\Test\Unit
{
  protected $controllerHelper;
  protected function _before()
  {
      $this->controllerHelper = new ControllerHelper();
  }

  public function testGetLookupValues(){
    $records = Array(
    Array
    (
        'id' => 1,
        'name' => 'test',
        'radio' => '19350',
        'checkboxes' => '19352,19353'
    ));
    $lookups = Array
    (
        Array
            (
                'id' => 19349,
                'form_table_id' => 4654,
                'form_field_name' => 'radio',
                'value' => 'Choice 1',
                'type' => 's08'
            ),
        Array
            (
                'id' => 19350,
                'form_table_id' => 4654,
                'form_field_name' => 'radio',
                'value' => 'Choice 2',
                'type' => 's08'
            ),

        Array
            (
                'id' => 19351,
                'form_table_id' => 4654,
                'form_field_name' => 'radio',
                'value' => 'Choice 3',
                'type' => 's08'
            ),
       Array(
                'id' => 19352,
                'form_table_id' => 4654,
                'form_field_name' => 'checkboxes',
                'value' => 'Choice 1',
                'type' => 's06'
            ),
        Array
            (
                'id' => 19353,
                'form_table_id' => 4654,
                'form_field_name' => 'checkboxes',
                'value' => 'Choice 2',
                'type' => 's06'
            ),
        Array
            (
                'id' => 19354,
                'form_table_id' => 4654,
                'form_field_name' => 'checkboxes',
                'value' => 'Choice 3',
                'type' => 's06'
            )
      );
    $this->controllerHelper->getLookupValues($records, $lookups);
    $expected = Array
    (
      'id' => 1,
      'name' => 'test',
      'radio' => 'Choice 2',
      'checkboxes' => 'Choice 1,Choice 2'
    );
    $this->assertTrue($this->arrays_are_similar($expected, $records[0]));
  }
  public function testGetFileUploadURL(){
    $records = Array(
    Array
    (
        'id' => 2,
        'name' => 'test',
        'upload_file' => 133
    ));
    $files = Array( Array(
      'id' => 133,
      'form_field_name' => 'upload_file',
      'filename' => 'test.pdf',
      'url' => 'https://fakeurl.com/fakepdf.pdf',
      'mimetype' => 'pdf',
      'filesize' => 3938
    ));
    $this->controllerHelper->getFileUploadURL($records, $files);
    $expected = Array
    (
        'id' => 2,
        'name' => 'test',
        'upload_file' => 'https://fakeurl.com/fakepdf.pdf'
    );
    $this->assertTrue($this->arrays_are_similar($expected, $records[0]));
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