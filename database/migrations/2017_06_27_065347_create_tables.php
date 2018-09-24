<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
        });

        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
        });

        Schema::create('user_form', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('form_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forms');
        Schema::drop('users');
        Schema::drop('user_form');
    }
}
