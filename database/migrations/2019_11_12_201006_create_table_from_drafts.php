<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFromDrafts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_table_drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('email');
            $table->string('host');
            $table->string('magiclink');
            $table->integer('form_table_id');
            $table->integer('form_record_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('table_from_drafts');
    }
}
