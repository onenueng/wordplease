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
            $table->unsignedInteger('id');
            $table->primary('id');
            $table->string('hn');
            $table->string('document_id')->nullable();
            $table->string('first_name',512)->nullable();
            $table->string('middle_name',512)->nullable();
            $table->string('last_name',512)->nullable();
            $table->string('first_name_old',1024)->nullable();
            $table->string('last_name_old',1024)->nullable();
            $table->date('dob')->nullable();
            $table->unsignedTinyInteger('gender')->nullable();
            $table->string('spouse', 512)->nullable();
            $table->string('tel_no', 512)->nullable();
            $table->string('alternative_contact', 512)->nullable();
            $table->string('mini_hash', config('constant.MINI_HASH_LENGTH'))->index();
            $table->timestamps(3);
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
