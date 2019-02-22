<?php

class TestCase extends Laravel\Lumen\Testing\TestCase
{

    /**
     * @var Faker\Generator
     */
    protected $faker;


    public function setUp()
    {
        $this->faker = Faker\Factory::create();
        parent::setUp();
        Artisan::call('migrate');
        //$this->artisan('db:seed');
    }
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        /*putenv('DB_CONNECTION=sqlite_testing');

        $app = require __DIR__ . '/../../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
        */
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}
