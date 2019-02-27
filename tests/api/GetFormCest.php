<?php 

class GetFormCest
{
    public function _before(ApiTester $I)
    {
        $this->userAttributes = [
            'email' => 'johndoe@example.com',
            'password' => 'johndoe',
        ];
    }

     // tests
       
    public function getFormViaAPI(\ApiTester $I){
        $I->sendPOST('/form/getApiToken', $this->userAttributes);
        $response = json_decode($I->grabResponse());
        
        $I->haveHttpHeader('authorization', 'Bearer '. $response->api_token);
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST('/form/getForm', ['form_id' => 1]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseContains('{"id":1');
    }

}
