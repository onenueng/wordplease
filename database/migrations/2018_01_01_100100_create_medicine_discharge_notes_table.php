<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineDischargeNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_discharge_notes', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->foreign('id')->references('id')->on('notes');
            $table->unsignedTinyInteger('admit_reason')->nullable();
            $table->text('principle_diagnosis')->nullable();
            $table->text('comorbids')->nullable();
            $table->text('complications')->nullable();
            $table->text('external_causes')->nullable();
            $table->string('other_diagnosis')->nullable();
            $table->text('OR_procedures')->nullable();
            $table->text('non_OR_procedures')->nullable();
            $table->string('chief_complaint')->nullable();
            $table->text('significant_findings')->nullable();
            $table->text('significant_procedured')->nullable();
            $table->text('hospital_course')->nullable();
            $table->text('condition_upon_discharge')->nullable();
            $table->unsignedTinyInteger('discharge')->nullable();
            $table->text('significant_medications_and_treatments_during_admission')->nullable();
            $table->text('home_medications')->nullable();
            $table->text('follow_up_schedule_and_instruction')->nullable();
            $table->text('MD_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_discharge_notes');
    }
}
