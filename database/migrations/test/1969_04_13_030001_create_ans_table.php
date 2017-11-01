<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ans', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('return_code')->nullable();
            // $table->string('request_computer_name')->nullable();
            $table->string('hn')->nullable();
            $table->string('an')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('admission_time')->nullable();
            $table->string('ward_number')->nullable();
            $table->string('ward_name')->nullable();
            $table->string('ward_brief_name')->nullable();
            $table->string('refer_doctor_code')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('patient_dept')->nullable();
            $table->string('patient_dept_name')->nullable();
            $table->string('patient_sub_dept')->nullable();
            $table->string('patient_sub_dept_name')->nullable();
            $table->string('discharge_date')->nullable();
            $table->string('discharge_time')->nullable();
            $table->string('discharge_type')->nullable();
            $table->string('discharge_type_name')->nullable();
            $table->string('discharge_status')->nullable();
            $table->string('discharge_status_name')->nullable();

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
        Schema::drop('ans');
    }
}
