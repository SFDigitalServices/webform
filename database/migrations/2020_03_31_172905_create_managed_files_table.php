<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagedFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managed_files', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('form_table_id');
            $table->string('form_table_name', 100);
            $table->string('filename', 255);
            $table->text('url');
            $table->string('mimetype', 100);
            $table->integer('fileesize');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managed_files');
    }
}
