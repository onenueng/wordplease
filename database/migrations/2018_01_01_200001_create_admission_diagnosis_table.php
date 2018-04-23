<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_diagnosis', function (Blueprint $table) {
            $table->string('tag');
            $table->string('name');
            $table->integer('admission_id')->unsigned();
            $table->primary(['tag', 'name', 'admission_id']);
            $table->foreign('admission_id')->references('id')->on('admissions');
            $table->unsignedTinyInteger('order');
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
        Schema::dropIfExists('admission_diagnosis');
    }
}
