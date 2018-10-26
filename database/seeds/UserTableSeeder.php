<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => app('hash')->make('johndoe'),
        ]);
        DB::table('user_form')->insert([
            'user_id' => 1,
            'form_id' => 1,
        ]);
        DB::table('forms')->insert([
            'content' => '',
        ]);
    }
}
