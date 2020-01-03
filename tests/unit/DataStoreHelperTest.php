<?php

namespace tests;

use Illuminate\Support\Facades\Schema;
use App\Helpers\DataStoreHelper;
use Illuminate\Foundation\Http\FormRequest;
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
            array('type' => 'text', 'id' => 'firstname', 'name' => 'firstname', 'label' => 'First Name', 'formtype' => 'c02'),
            array('type' => 'text', 'id' => 'lastname', 'name' => 'lastname', 'label' => 'Last Name', 'formtype' => 'c02'),
            array('type' => 'email', 'id' => 'email', 'name' => 'email', 'maxlength' => '25', 'required' => 'true', 'label' => 'Email', 'formtype' => 'c04'),
            array('type' => 'password', 'id'=> 'password', 'name' => 'password', 'label' => 'Password', 'formtype' => 'c02'),
            array('type' => 'tel', 'id' => 'phonenumber', 'name' => 'phonenumber', 'required' => 'false', 'label' => 'Tel', 'formtype' => 'c06'),
            array('type' => 'date', 'id' => 'date_created', 'name' => 'date_created', 'label' => 'Date', 'formtype' => 'd02'),
            array('type' => 'url', 'id' => 'url', 'name' => 'url', 'label' => 'URL', 'formtype' => 'd10'),
        );
    }
    protected function createRequest(
      $method,
      $content,
      $uri = '/test',
      $server = ['CONTENT_TYPE' => 'application/json'],
      $parameters = [],
      $cookies = [],
      $files = []
     )
     {
         $request = new \Illuminate\Http\Request;
         return $request->createFromBase(
          \Symfony\Component\HttpFoundation\Request::create(
              $uri,
              $method,
              $parameters,
              $cookies,
              $files,
              $server,
              $content
          )
      );
     }

    /**
    *  Testing App\Helpers\DataStoreHelper
    **/
    public function testSubmitForm(){
      //submitForm($form, $request, $status = 'complete')
      $tablename= 'forms_submitform';
      $this->dataStoreHelperTester->createFormTable($tablename, $this->definitions);
      $this->assertTrue(Schema::hasTable($tablename));
      $form = array(
          "host" => "",
          "id" => 'submitform',
          "content" => array(
            "settings" => array("name" => ""),
            "data" => $this->definitions
          )
        );
      $requestData = array("form_id" => "submitform", "firstname" => 'firstname', "lastname" => "lastname", "email" => "test@test.gov", "phonenumber" => "12345678901", "password" => "", "date_created" => "", "url" => "");

      $request = $this->createRequest("POST", json_encode($requestData), '/test', ['CONTENT_TYPE' => 'application/json']);

      //Test completed form
      $response = $this->dataStoreHelperTester->submitForm($form, $request, 'complete');
      $this->assertEquals($response['status'], 1);
      $this->assertEquals($response['message'], "Successful");
      //Test partially completed form
      $response = $this->dataStoreHelperTester->submitForm($form, $request, 'partial');
      $this->assertEquals($response['status'], 1);
      $this->assertEquals(is_array($response['data']), true);

    }
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
                    $this->assertEquals($column['type'], 'text');
                    $this->assertEquals($column['name'], 'name');
                    $this->assertEquals($column['length'], '255');
                    break;
                case 'email': $this->assertEquals($column['type'], 'text');
                    break;
                case 'password': $this->assertEquals($column['type'], 'text');
                    break;
                case 'phonenumber': $this->assertEquals($column['type'], 'text');
                    break;
                case 'date_created': $this->assertEquals($column['type'], 'date');
                    break;
                case 'my_time': $this->assertEquals($column['type'], 'time');
                    break;
                case 'my_url': $this->assertEquals($column['type'], 'text');
                    break;
                case 'my_number': $this->assertEquals($column['type'], 'decimal');
                    break;
                case 'my_textarea': $this->assertEquals($column['type'], 'longText');
                    break;
                case 'my_radio': $this->assertEquals($column['type'], 'text');
                    break;
                case 'my_cb': $this->assertEquals($column['type'], 'text');
                    break;
                case 'my_file': $this->assertEquals($column['type'], 'text');
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
      $draft = '';
      foreach ($results as $result) {
        foreach($result as $key => $value){
          if($key === 'magiclink')
            $draft = $value;
          if(! in_array($key, $content)) continue;
            $this->assertEquals($content[$key], $result->$key);
        }
      }

      // test retrieval
      $this->testRetriveFormData('999999', $draft);
    }
    private function testRetriveFormData($formid, $draft)
    {
        $data = $this->dataStoreHelperTester->retrieveFormDraft($formid, $draft);
        $this->assertNotNull($data);
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
        Schema::dropIfExists('forms_submitform');
        Schema::dropIfExists('forms_submitform_archive');
    }
  }
