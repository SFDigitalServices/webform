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
     public function getFormViaAPI(\ApiTester $I)
     {
       // send credential data
        $I->sendPOST('/home', $this->userAttributes);
        $response = $I->grabResponse();
        
        // login success
        $I->seeResponseCodeIs(200);


         /*$I->amHttpAuthenticated('johndoe@example.com', 'johndoe');
         $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
         $I->sendPOST('/form/getForm', ['form_id' => 1]);
         $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
         $I->seeResponseIsJson();
         $I->seeResponseContains('{"result":"ok"}');
         */
         
     }
}
