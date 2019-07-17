<?php

namespace tests;

use Illuminate\Support\Facades\Schema;
use App\Helpers\DataStoreHelper;
use Log;

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
        $columns = array();
        foreach($this->definitions as $definition){
            array_push($columns, $definition['id']);
        }
        $this->assertTrue(Schema::hasColumns($tablename, $columns));
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
                case 'my_radio': $this->assertEquals($column['type'], 'integer');
                    break;
                case 'my_cb': $this->assertEquals($column['type'], 'integer');
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
        $this->assertNotTrue(Schema::hasColumns($tablename, array('firstname')));
        $this->assertTrue(Schema::hasColumns($tablename, array('lastname')));
    }
    protected function _after()
    {
        Schema::dropIfExists('forms_form1');
        Schema::dropIfExists('forms_form2');
        Schema::dropIfExists('forms_form3');
        Schema::dropIfExists('forms_form4');
        Schema::dropIfExists('forms_form5');
        Schema::dropIfExists('field_mapping');
    }

}