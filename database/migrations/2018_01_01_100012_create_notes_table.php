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
            $table->integer('admission_id')->unsigned()->index();
            $table->foreign('admission_id')->references('id')->on('admissions');

            $table->tinyInteger('note_type_id')->unsigned()->index();
            $table->foreign('note_type_id')->references('id')->on('note_types');

            $table->string('retitle', 60)->nullable();
            $table->tinyInteger('class')->unsigned();
            $table->smallInteger('ward_id')->unsigned()->nullable()->index();
            $table->foreign('ward_id')->references('id')->on('wards');

            $table->smallInteger('attending_staff_id')->unsigned()->nullable()->index();
            $table->foreign('attending_staff_id')->references('id')->on('attending_staffs');

            $table->smallInteger('created_by')->unsigned()->default(0)->index();
            $table->foreign('created_by')->references('id')->on('users');
            
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
        Schema::dropIfExists('notes');
    }
}
