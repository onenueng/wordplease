<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->primary('id');
            $table->string('an');
            $table->string('mini_hash', 7)->index();
            $table->unsignedInteger('patient_id')->index();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedSmallInteger('insurance_id')->index();
            $table->foreign('insurance_id')->references('id')->on('insurances');
            $table->string('patient_name', 512);
            $table->dateTime('datetime_admit')->nullable();
            $table->dateTime('datetime_discharge')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
