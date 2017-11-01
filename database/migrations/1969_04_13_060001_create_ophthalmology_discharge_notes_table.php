<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOphthalmologyDischargeNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ophthalmology_discharge_notes', function (Blueprint $table) {
            $table->integer('id');
            $table->primary('id'); // relation on notes.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ophthalmology_discharge_notes');
    }
}
