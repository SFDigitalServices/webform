<?php

use App\User;
use \Codeception\Util\Locator;

class AuthCest
{
    public function authenticateWithApiToken(FunctionalTester $I)
    {
        // save this test for later when SSO is integrated
        /*$user = $I->have(User::class);

        $I->amOnPage('/');
        $I->seeResponseCodeIs(401);

        $I->amOnPage('/secure?api_token=' . $user->api_token);
        $I->seeResponseCodeIs(200);
        $I->see('Secure');
        */
    }

    public function authenticateWithAmLoggedAs(FunctionalTester $I)
    {

         // write test if using Lumen's authentication system
        
             $I->amOnPage('/');
             $I->fillField('email', 'johndoe@example.com');
             $I->fillField('password', 'johndoe');
             $I->click('Continue');
             $I->seeCurrentUrlEquals('/home');
    
    }
}
