<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FormsTest extends TestCase
{
    use DatabaseMigrations; // <-- roll back database after each test and migrate it before next test. This is a Lumen trait that does it automatically.

    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function testLogin()
    {
        $this->json('POST', '/', ['email' => 'johndoe@example.com', 'password' => 'johndoe'])
             ->seeJson([
                'api_token' => true,
             ]);
    }
    public function testGetUserForms()
    {
        
    }

    public function testGetForm()
    {
      
    }

}
