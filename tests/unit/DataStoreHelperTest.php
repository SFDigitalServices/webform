<?php

namespace tests;

use Illuminate\Support\Facades\Schema;
use App\Helpers\DataStoreHelper;
use Log;
use DB;
class DataStoreHelperTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $dataStoreHelperTester;
    protected $definitions;

    protected function _before()
    {
        $this->dataStoreHelperTester = new DataStoreHelper();

        $this->definitions = array(
            array('type' => 'text', 'id' => 'firstname'),
            array('type' => 'text', 'id' => 'lastname'),
            array('type' => 'email', 'id' => 'email', 'maxlength' => '25', 'required' => 'true'),
            array('type' => 'password', 'id'=> 'password'),
            array('type' => 'tel', 'id' => 'phonenumber', 'required' => 'false'),
            array('type' => 'date', 'id' => 'date_created'),
            array('type' => 'url', 'id' => 'url'),
        );
    }

    /**
    *  Testing App\Helpers\DataStoreHelper
    **/
    public function testCreateFormTable()
    {
        $tablename= 'forms_form1';
        $this->dataStoreHelperTester->createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));
        $this->assertTrue(Schema::hasTable($tablename."_archive"));
        $columns = array();
        foreach($this->definitions as $definition){
            array_push($columns, $definition['id']);
        }
        $this->assertTrue(Schema::hasColumns($tablename, $columns));
    }
    public function testCloneFormTable()
    {
        $tablename= 'forms_cloneme';
        $this->dataStoreHelperTester->createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));
        $this->assertTrue(Schema::hasTable($tablename."_archive"));

        $cloned = "forms_cloneme_clone";
        $this->dataStoreHelperTester->cloneFormTable($tablename, $cloned);
        $this->assertTrue(Schema::hasTable($cloned));
        $this->assertTrue(Schema::hasTable($cloned."_archive"));
    }
    public function testFieldMapping(){
        $tablename= 'field_mapping';
        $mapping_definitions = array(
            array('type' => 'text', 'id' => 'name'),
            array('type' => 'email', 'id' => 'email', 'maxlength' => '25', 'required' => 'true'),
            array('type' => 'password', 'id'=> 'password'),
            array('type' => 'tel', 'id' => 'phonenumber', 'required' => 'false'),
            array('type' => 'date', 'id' => 'date_created'),
            array('type' => 'url', 'id' => 'my_url'),
            array('formtype' => 'd04', 'id' => 'my_time', 'value' => '00:00:00'),
            array('type' => 'file', 'id' => 'my_file', 'required' => 'false'),
            array('formtype' => 'i14', 'id' => 'my_textarea'),
            array('type' => 'number', 'id' => 'my_number', 'value' => '10'),
            array('formtype' => 's08', 'id' => 'my_radio', 'radios' => '["Option one","Option two","three","four"]'),
            array('formtype' => 's06', 'id' => 'my_cb', 'checkboxes' => '["CB one","CB two","CB three","four"]'),
        );
        $mytable = $this->dataStoreHelperTester->createFormTable($tablename, $mapping_definitions);
        $this->assertTrue(Schema::hasTable($tablename));

        foreach($mytable->getColumns() as $column){
            // assert each column definition from above, need to add more asserts for attributes.
            switch ($column['name']) {
                case 'id': break;
                case 'name':
                    $this->assertEquals($column['type'], 'string');
                    $this->assertEquals($column['name'], 'name');
                    $this->assertEquals($column['length'], '255');
                    break;
                case 'email': $this->assertEquals($column['type'], 'string');
                    break;
                case 'password': $this->assertEquals($column['type'], 'string');
                    break;
                case 'phonenumber': $this->assertEquals($column['type'], 'string');
                    break;
                case 'date_created': $this->assertEquals($column['type'], 'date');
                    break;
                case 'my_time': $this->assertEquals($column['type'], 'time');
                    break;
                case 'my_url': $this->assertEquals($column['type'], 'string');
                    break;
                case 'my_number': $this->assertEquals($column['type'], 'decimal');
                    break;
                case 'my_textarea': $this->assertEquals($column['type'], 'longText');
                    break;
                case 'my_radio': $this->assertEquals($column['type'], 'string');
                    break;
                case 'my_cb': $this->assertEquals($column['type'], 'string');
                    break;
                case 'my_file': $this->assertEquals($column['type'], 'string');
                    break;
                default:
                    break;
            }
        }
    }
    public function testDropFormTableColumn() {
        $tablename= 'forms_form5';
        $this->dataStoreHelperTester->createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));
        $definition = array('email', 'firstname');
        $_fluent = $this->dataStoreHelperTester->dropFormTableColumn($tablename, $definition);
        $this->assertNotTrue(Schema::hasColumns($tablename, array('email')));
        $this->assertTrue(Schema::hasColumns($tablename."_archive", array('email')));
        $this->assertNotTrue(Schema::hasColumns($tablename, array('firstname')));
        $this->assertTrue(Schema::hasColumns($tablename."_archive", array('firstname')));
        $this->assertTrue(Schema::hasColumns($tablename, array('lastname')));
    }

    public function testInsertFormData(){
      $tablename= 'forms_999999';
      $mapping_definitions = array(
          array('type' => 'text', 'id' => 'name'),
          array('type' => 'email', 'id' => 'email', 'maxlength' => '25', 'required' => 'true'),
          array('type' => 'password', 'id'=> 'password'),
          array('type' => 'tel', 'id' => 'phonenumber', 'required' => 'false'),
          array('type' => 'date', 'id' => 'date_created'),
          array('type' => 'url', 'id' => 'my_url'),
          array('type' => 'text', 'id' => 'my_address'),
          array('type' => 'text', 'id' => 'my_city'),
          array('type' => 'text', 'id' => 'my_zipcode'),
          array('formtype' => 'd04', 'id' => 'my_time', 'value' => '00:00:00'),
          array('type' => 'file', 'id' => 'my_file', 'required' => 'false'),
          array('formtype' => 'i14', 'id' => 'my_textarea'),
          array('type' => 'number', 'id' => 'my_number', 'value' => '10'),
          array('type' => 'number', 'id' => 'my_price', 'value' => '10.00'),
          array('formtype' => 's08', 'id' => 'my_radio', 'radios' => '["Option one","Option two","three","four"]'),
          array('formtype' => 's06', 'id' => 'my_cb', 'checkboxes' => '["CB one","CB two","CB three","four"]'),
      );
      $mytable = $this->dataStoreHelperTester->createFormTable($tablename, $mapping_definitions);
      $this->assertTrue(Schema::hasTable($tablename));

      $content = Array(
          'email'=> 'henry.jiang@sfgov.org',
          'name' => 'test',
          'password' => 'test',
          'phonenumber' => '4155824055',
          'date' => ' 2019-07-23 00:00:00',
          'url' => 'http://google.com',
          'my_address' => '123 sample st',
          'my_city' => 'sf',
          'my_zipcode' => '12345',
          'my_time' => '12:00:00',
          'my_file' => 'path_to_file',
          'my_number' => '20',
          'my_price' => '20.99',
          'my_radio' => '12',
          'my_cb' => '11,12',
      );
      $this->dataStoreHelperTester->insertFormData($content, '999999');

      $results = DB::table('forms_999999')->get();
      foreach ($results as $result) {
        foreach($result as $key => $value){
          if(! in_array($key, $content)) continue;
            $this->assertEquals($content[$key], $result->$key);
        }
      }
    }
    protected function _after()
    {
        Schema::dropIfExists('forms_form1');
        Schema::dropIfExists('forms_form1_archive');
        Schema::dropIfExists('forms_form2');
        Schema::dropIfExists('forms_form2_archive');
        Schema::dropIfExists('forms_form3');
        Schema::dropIfExists('forms_form3_archive');
        Schema::dropIfExists('forms_form4');
        Schema::dropIfExists('forms_form4_archive');
        Schema::dropIfExists('forms_form5');
        Schema::dropIfExists('forms_form5_archive');
        Schema::dropIfExists('field_mapping');
        Schema::dropIfExists('field_mapping_archive');
        Schema::dropIfExists('forms_999999');
        Schema::dropIfExists('forms_999999_archive');
        Schema::dropIfExists('forms_cloneme');
        Schema::dropIfExists('forms_cloneme_archive');
        Schema::dropIfExists('forms_cloneme_clone');
        Schema::dropIfExists('forms_cloneme_clone_archive');
    }
  }
