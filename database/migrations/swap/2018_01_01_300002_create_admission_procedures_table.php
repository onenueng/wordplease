<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_procedures', function (Blueprint $table) {
            $table->string('tag');
            $table->string('name');
            $table->unsignedInteger('admission_id');
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
        Schema::dropIfExists('admission_procedures');
    }
}
