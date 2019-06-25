<?php

namespace App\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnumMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::dropIfExists('enum_mappings');
    }
}
