<?php

class RecordCest
{

    private $userAttributes;

    public function _before()
    {
        $this->userAttributes = [
            'email' => 'johndoe@example.com',
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
            'user_id' => 1,
            'form_id' => 1,
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
        $user_id = $I->haveRecord('users', $this->userAttributes);
        $I->haveRecord('user_form', ['user_id' => $user_id, 'form_id' => $form_id]);

        $I->seeRecord('user_form', ['user_id' => $user_id, 'form_id' => $form_id]);
        $I->dontSeeRecord('user_form', ['user_id' => $user_id, 'form_id' => 999]);
    }

    public function testHaveRecordWithModelUserForm(FunctionalTester $I)
    {
        $form_id = $I->haveRecord('App\Form', $this->formsAttributes);
        $user_id = $I->haveRecord('App\User', $this->userAttributes);

        $user_form = $I->haveRecord('App\User_Form', ['user_id' => $user_id, 'form_id' => $form_id]);

        $I->seeRecord('App\User_Form', ['user_id' => $user_id, 'form_id' => $form_id]);
        $I->dontSeeRecord('App\User_Form', ['user_id' => $user_id, 'form_id' => 999 ]);
    }

    public function testGrabRecordWithTableUserForm(FunctionalTester $I)
    {
        $I->haveRecord('App\User_Form', $this->userFormAttributes);

        $record = $I->grabRecord('user_form', ['user_id' => 1, 'form_id' => 1]);

        $I->assertTrue(is_array($record));
    }

    public function testGrabRecordWithModelUserForm(FunctionalTester $I)
    {
        $I->haveRecord('App\User_Form', $this->userFormAttributes);

        $model = $I->grabRecord('App\User_Form', ['user_id' => 1]);

        $I->assertTrue($model instanceof App\User_Form);
    }

    // Users tests
    public function testHaveRecordWithTableUsers(FunctionalTester $I)
    {
        $id = $I->haveRecord('users', $this->userAttributes);

        $I->seeRecord('users', ['id' => $id, 'email' => 'johndoe@example.com']);
        $I->dontSeeRecord('users', ['id' => $id, 'email' => 'janedoe@example.com']);
    }

    public function testHaveRecordWithModelUsers(FunctionalTester $I)
    {
        $user = $I->haveRecord('App\User', $this->userAttributes);

        $I->seeRecord('App\User', ['id' => $user->id, 'email' => 'johndoe@example.com']);
        $I->dontSeeRecord('App\User', ['id' => $user->id, 'email' => 'janedoe@example.com']);
    }

    public function testGrabRecordWithTableUsers(FunctionalTester $I)
    {
        $I->haveRecord('App\User', $this->userAttributes);

        $record = $I->grabRecord('users', ['email' => 'johndoe@example.com']);

        $I->assertTrue(is_array($record));
    }

    public function testGrabRecordWithModelUsers(FunctionalTester $I)
    {
        $I->haveRecord('App\User', $this->userAttributes);

        $model = $I->grabRecord('App\User', ['email' => 'johndoe@example.com']);

        $I->assertTrue($model instanceof App\User);
    }


     // executed after each test
     protected function _after()
     {
     }
}
