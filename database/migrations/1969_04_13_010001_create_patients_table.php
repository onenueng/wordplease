<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up() {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('patient_type_id')->unsigned()->nullable();
            $table->string('national_id')->nullable(); // encrypt.
            $table->string('HN'); // encrypt.
            $table->smallInteger('title_id')->unsigned()->nullable();
            $table->string('first_name',512)->nullable(); // encrypt.
            $table->string('middle_name',512)->nullable(); // encrypt.
            $table->string('last_name',512)->nullable(); // encrypt.
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->unsigned()->nullable();
            $table->tinyInteger('race_id')->unsigned()->nullable();
            $table->tinyInteger('nation_id')->unsigned()->nullable();
            $table->tinyInteger('marital_status_id')->unsigned()->nullable();
            $table->string('spouse', 512)->nullable(); // encrypt.
            $table->string('address',100)->nullable();
            $table->mediumInteger('postcode_id')->unsigned()->nullable();
            $table->string('tel_no', 512)->nullable(); // encrypt.
            $table->string('mobile_no', 512)->nullable(); // encrypt.
            $table->string('person_to_notify', 512)->nullable();  // encrypt.
            $table->string('person_to_notify_address', 100)->nullable();
            $table->string('person_to_notify_tel_no', 512)->nullable();
            $table->tinyInteger('person_to_notify_relative_type_id')->unsigned()->nullable();
            $table->timestamps();
            $table->string('cat_code', 8);
            $table->index('cat_code');
        });
    }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('patients');
  }
}
