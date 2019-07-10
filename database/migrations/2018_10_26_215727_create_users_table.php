<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_token');
            $table->timestamps();
        });

        Schema::dropIfExists('user_form');
        Schema::create('user_form', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('form_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('forms');
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::dropIfExists('enum_mappings');
        Schema::create('enum_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('form_table_id');
            $table->string('form_field_name');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
