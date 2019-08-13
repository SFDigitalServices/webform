<?php

use App\Helpers\DataStoreHelper;
use DB;

class GetFormCest
{
    protected $apikey = '';
    protected $formid = 1122;
    public function _before(ApiTester $I)
    {
        $this->userAttributes = [
            'email' => 'johndoe@example.com',
            'password' => 'johndoe',
        ];

        $I->sendPOST('/form/getApiToken', $this->userAttributes);
        $response = json_decode($I->grabResponse());
        $this->apikey = $response->api_token;
    }

    // Need to find a way to use Mocking
    private function createDB(){
      $tablename = "forms_".$this->formid;
      $definitions = array(
        array('type' => 'text', 'id' => 'firstname'),
        array('type' => 'text', 'id' => 'lastname'),
        array('type' => 'email', 'id' => 'email', 'maxlength' => '25', 'required' => 'true'),
        array('type' => 'password', 'id'=> 'password'),
        array('type' => 'tel', 'id' => 'phonenumber', 'required' => 'false'),
        array('type' => 'date', 'id' => 'date_created'),
        array('type' => 'url', 'id' => 'url'),
      );

      $dataStoreHelperTester = new DataStoreHelper();
      $dataStoreHelperTester->createFormTable($tablename, $definitions);

      $testDataSet = [
          'email' => 'john@example.com',
          'name' => 'John Doe',
          'address' => '1 south vaness',
          'multiple_checkboxes' => '207',
          'select_dropdown' => 'enter'
        ];
      DB::table($tablename)->insert($testDataSet);

      // insert lookup table value
      DB::table('enum_mappings')->insert(
        ['form_table_id' => $this->formid, "form_field_name" => "multiple_checkboxes", "value" => "option 1"]
      );
    }

     // tests
    public function getFormViaAPI(\ApiTester $I){
        $I->haveHttpHeader('authorization', 'Bearer '. $this->apikey);
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('/form/getForm', ['form_id' => 1]); // get form #1, this is the form created in the migration script
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContains('{"id":1');
    }

    public function testGetFormData(\ApiTester $I){
        $params = [
          'formid' => $this->formid,
        ];
        $I->haveHttpHeader('authorization', 'Bearer '. $this->apikey);
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('/api/getFormData', $params);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $response = json_decode($I->grabResponse());
    }
    public function testGetFormSchema(\ApiTester $I){
      $params = [
        'formid' => $this->formid,
      ];
      $I->haveHttpHeader('authorization', 'Bearer '. $this->apikey);
      $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
      $I->sendPOST('/api/getFormSchema', $params);
      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $response = json_decode($I->grabResponse());
    }
    public function testGetLookupTable(\ApiTester $I){
      $params = [
        'formid' => $this->formid,
      ];
      $I->haveHttpHeader('authorization', 'Bearer '. $this->apikey);
      $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
      $I->sendPOST('/api/getLookupTable', $params);
      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $response = json_decode($I->grabResponse());
    }

    public function testGetArchivedFormData(\ApiTester $I){
      $params = [
        'formid' => $this->formid,
      ];
      $I->haveHttpHeader('authorization', 'Bearer '. $this->apikey);
      $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
      $I->sendPOST('/api/getArchivedFormData', $params);
      $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
      $I->seeResponseIsJson();

      $response = json_decode($I->grabResponse());
    }
}
