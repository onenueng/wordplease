<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineServiceNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_service_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('note_id')->unsigned()->unique();
            // $table->integer('id')->unsigned();
            // $table->primary('id');
            // field HN type integer
            $table->integer('HN')->unsigned();
            // field patient_name type string
            $table->string('patient_name', 120);
            // field gender type boolean
            $table->boolean('gender');
            // field age type tinyInteger
            $table->tinyInteger('age')->nullable();
            // field AN type integer
            $table->integer('AN')->unsigned();
            // field date_admit type date
            $table->datetime('date_admit')->nullable();
            // field ward_id smallInteger
            $table->smallInteger('ward_id')->unsigned();
            // field resident_id type smallInteger
            $table->smallInteger('resident_id')->nullable();
            // field chief_complaint type mediumText
            $table->mediumText('chief_complaint');
            // field comorbids type mediumText
            $table->mediumText('comorbids');
            // field history_present_illness type text
            $table->text('history_present_illness');
            // field physical_exam type text
            $table->text('physical_exam');
            // field hospital_course type mediumText
            $table->mediumText('hospital_course');
            // field OR_procedure type mediumText
            $table->mediumText('OR_procedure');
            // field non_OR_procedure type mediumText
            $table->mediumText('non_OR_procedure');
            // field assessment_and_plan type mediumText
            $table->mediumText('assessment_and_plan');
            $table->integer('creator')->unsigned(); //relation on users
            $table->integer('updater')->unsigned(); //relation on users
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
        Schema::drop('medicine_service_notes');
    }
}
