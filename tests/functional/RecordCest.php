<?php

class RecordCest
{

    private $userAttributes;

    public function _before()
    {
        $this->userAttributes = [
            'email' => 'johndoe@example.com',
            'password' => app('hash')->make('johndoe'),
            'name' => 'john doe',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'api_token' => str_random(),
        ];

        $this->formsAttributes = [
            //'content' => '{"settings":{"action":"","method":"POST","name":"Second Form"},"data":[{"label":"Name","placeholder":"placeholder","help":"Supporting help text","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"Email","placeholder":"placeholder","help":"Supporting help text","id":"email","formtype":"c04","name":"email","type":"email","required":"true"}]}',
            'content' => 'TEST FORM',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        
        $this->userFormAttributes = [
            'user_id' => 999,
            'form_id' => 999,
        ];

    }

    // Forms tests
    public function testHaveRecordWithTableForms(FunctionalTester $I)
    {
        $id = $I->haveRecord('forms', $this->formsAttributes);

        $I->seeRecord('forms', ['id' => $id, 'content' => 'TEST FORM']);
        $I->dontSeeRecord('forms', ['id' => $id, 'content' => '']);
    }

    public function testHaveRecordWithModelForms(FunctionalTester $I)
    {
        $form = $I->haveRecord('App\Form', $this->formsAttributes);

        $I->seeRecord('App\Form', ['id' => $form->id, 'content' => 'TEST FORM']);
        $I->dontSeeRecord('App\Form', ['id' => $form->id, 'content' => '']);
    }

    public function testGrabRecordWithTableForms(FunctionalTester $I)
    {
        $I->haveRecord('App\Form', $this->formsAttributes);

        $record = $I->grabRecord('forms', ['content' => 'TEST FORM']);

        $I->assertTrue(is_array($record));
    }

    public function testGrabRecordWithModelForms(FunctionalTester $I)
    {
        $I->haveRecord('App\Form', $this->formsAttributes);

        $model = $I->grabRecord('App\Form', ['content' => 'TEST FORM']);

        $I->assertTrue($model instanceof App\Form);
    }

    // User Form
    public function testHaveRecordWithTableUserForm(FunctionalTester $I)
    {
        $form_id = $I->haveRecord('forms', $this->formsAttributes);

        $user_id = $I->haveRecord('users', ['email' => 'testuser@example.com', 'name'=> 'test user', 'api_token' => str_random(), 'password' => app('hash')->make('johndoe')]);

        $I->haveRecord('user_form', ['user_id' => $user_id, 'form_id' => $form_id]);

        $I->seeRecord('user_form', ['user_id' => $user_id, 'form_id' => $form_id]);
        $I->dontSeeRecord('user_form', ['user_id' => $user_id, 'form_id' => 999]);
    }

    public function testHaveRecordWithModelUserForm(FunctionalTester $I)
    {
        $form_id = $I->haveRecord('App\Form', $this->formsAttributes);
        $user_id = $I->haveRecord('App\User', ['email' => 'testuser1@example.com', 'name'=> 'test user1', 'api_token' => str_random(), 'password' => app('hash')->make('johndoe')]);

        $user_form = $I->haveRecord('App\User_Form', ['user_id' => $user_id, 'form_id' => $form_id]);

        $I->seeRecord('App\User_Form', ['user_id' => $user_id, 'form_id' => $form_id]);
        $I->dontSeeRecord('App\User_Form', ['user_id' => $user_id, 'form_id' => 999 ]);
    }

    public function testGrabRecordWithTableUserForm(FunctionalTester $I)
    {
        $I->haveRecord('App\User_Form', $this->userFormAttributes);

        $record = $I->grabRecord('user_form', ['user_id' => 999, 'form_id' => 999]);

        $I->assertTrue(is_array($record));
    }

    public function testGrabRecordWithModelUserForm(FunctionalTester $I)
    {
        $I->haveRecord('App\User_Form', $this->userFormAttributes);

        $model = $I->grabRecord('App\User_Form', ['user_id' => 999]);

        $I->assertTrue($model instanceof App\User_Form);
    }

    // Users tests
    public function testHaveRecordWithTableUsers(FunctionalTester $I)
    {
        $id = $I->haveRecord('users', ['email' => 'testuser2@example.com', 'name'=> 'test user2', 'api_token' => str_random(), 'password' => app('hash')->make('johndoe')]);

        $I->seeRecord('users', ['id' => $id, 'email' => 'testuser2@example.com']);
        $I->dontSeeRecord('users', ['id' => $id, 'email' => 'janedoe@example.com']);
    }

    public function testHaveRecordWithModelUsers(FunctionalTester $I)
    {
        $user = $I->haveRecord('App\User', ['email' => 'testuser3@example.com', 'name'=> 'test user3', 'api_token' => str_random(), 'password' => app('hash')->make('johndoe')]);

        $I->seeRecord('App\User', ['id' => $user->id, 'email' => 'testuser3@example.com']);
        $I->dontSeeRecord('App\User', ['id' => $user->id, 'email' => 'janedoe@example.com']);
    }

    public function testGrabRecordWithTableUsers(FunctionalTester $I)
    {
        $I->haveRecord('App\User', ['email' => 'testuser4@example.com', 'name'=> 'test user4', 'api_token' => str_random(), 'password' => app('hash')->make('johndoe')]);

        $record = $I->grabRecord('users', ['email' => 'testuser4@example.com']);

        $I->assertTrue(is_array($record));
    }

    public function testGrabRecordWithModelUsers(FunctionalTester $I)
    {
        $I->haveRecord('App\User', ['email' => 'testuser5@example.com', 'name'=> 'test user5', 'api_token' => str_random(), 'password' => app('hash')->make('johndoe')]);

        $model = $I->grabRecord('App\User', ['email' => 'testuser5@example.com']);

        $I->assertTrue($model instanceof App\User);
    }


     // executed after each test
     protected function _after()
     {

     }
}
