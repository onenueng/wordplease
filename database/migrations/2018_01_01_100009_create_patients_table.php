<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->string('hn');
            $table->string('document_id')->nullable();
            $table->string('first_name',512)->nullable();
            $table->string('middle_name',512)->nullable();
            $table->string('last_name',512)->nullable();
            $table->string('first_name_old',1024)->nullable();
            $table->string('last_name_old',1024)->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->unsigned()->nullable();
            $table->string('spouse', 512)->nullable();
            // $table->string('address',512)->nullable();
            // $table->mediumInteger('postcode_id')->unsigned()->nullable();
            $table->string('tel_no', 512)->nullable();
            $table->string('alternative_contact', 512)->nullable();
            $table->string('mini_hash', 7)->index();
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
        Schema::dropIfExists('patients');
    }
}
