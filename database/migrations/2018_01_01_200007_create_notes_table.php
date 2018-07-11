<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->unsignedInteger('admission_id')->index();
            $table->foreign('admission_id')->references('id')->on('admissions');
            $table->unsignedTinyInteger('note_type_id')->index();
            $table->foreign('note_type_id')->references('id')->on('note_types');
            $table->string('retitle', 60)->nullable();
            $table->unsignedTinyInteger('class');
            $table->unsignedSmallInteger('ward_id')->default(0)->index();
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->string('ward_other', 90)->nullable();
            $table->unsignedSmallInteger('attending_staff_id')->default(0)->index();
            $table->foreign('attending_staff_id')->references('id')->on('attending_staffs');
            $table->string('attending_staff_other', 160)->nullable();
            $table->unsignedSmallInteger('division_id')->default(0)->index();
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('division_other', 120)->nullable();
            $table->unsignedMediumInteger('created_by')->default(0)->index();
            $table->foreign('created_by')->references('id')->on('users');
            $table->boolean('published')->default(false);
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
        Schema::dropIfExists('notes');
    }
}
