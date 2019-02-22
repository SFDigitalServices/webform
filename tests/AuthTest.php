<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations; // <-- roll back database after each test and migrate it before next test. This is a Lumen trait that does it automatically.

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginWithWrongValidation()
    {
        /* $this->json('post', 'api/auth/login', [
            'email'     => $this->faker->email,
            'password'  => 'asdasd'
        ])->seeJson([
            'message'   => 'invalid_credentials'
        ])->assertResponseStatus(401);
        */
    }

    /**
     *
     */
    public function testCorrectLogin()
    {
      
        $user = factory('App\User')->make([
            'name' => 'John Doe1',
            'email' => 'johndoe1@example.com',
            'password' => app('hash')->make('johndoe')
        ]);

        var_dump("Create user: ". $user['name']);
        /*
        $email = $this->faker->email;
        $password = str_random(8);

        factory(\App\User::class)->create([
            'email' => $email,
            'password' => app('hash')->make($password)
        ]);

        $this->json('post', 'api/auth/login', [
            'email'     => $email,
            'password'  => $password
        ])
            ->assertResponseOk();
        */
        // just test to see if user exist in database.
       // $this->seeInDatabase('users', ['email' => 'johndoe@example.com']);
    }

}
