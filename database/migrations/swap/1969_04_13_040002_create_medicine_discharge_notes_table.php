<?php

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
        //
        Schema::create('medicine_discharge_notes', function (Blueprint $table) {
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
            $table->integer('AN')->unsigned()->unique();
            // field date_admit type date
            $table->datetime('date_admit')->nullable();
            // field ward_id smallInteger
            $table->smallInteger('ward_id')->unsigned();
            // field ward_name
            // $table->string('ward_name')->nuallable();


            // field attending_id type smallInteger
            $table->smallInteger('attending_id')->nullable();
            // field resident_id type smallInteger
            $table->smallInteger('resident_id')->nullable();
            // field date_dc type date
            $table->datetime('date_dc')->nullable();
            // field main_division_id type smallInteger
            $table->smallInteger('main_division_id')->nullable();
            // field co_division_id type smallInteger
            $table->smallInteger('co_division_id')->nullable();
            // field principle_diagnosis type mediumText
            $table->mediumText('principle_diagnosis');
            // field reason_admit type mediumText
            $table->mediumText('reason_admit');
            // field comorbids type mediumText
            $table->mediumText('comorbids');
            // field complications type mediumText
            $table->mediumText('complications');
            // field external_causes type mediumText
            $table->mediumText('external_causes');
            // field other_diagnosis type mediumText
            $table->mediumText('other_diagnosis');
            // field OR_procedure type mediumText
            $table->mediumText('OR_procedure');
            // field non_OR_procedure type mediumText
            $table->mediumText('non_OR_procedure');
            // field chief_complaint type mediumText
            $table->mediumText('chief_complaint');
            // field significant_findings type mediumText
            $table->mediumText('significant_findings');
            // field significant_procedured type mediumText
            $table->mediumText('significant_procedured');
            // field hospital_course type mediumText
            $table->mediumText('hospital_course');
            // field condition_upon_DC type mediumText
            $table->mediumText('condition_upon_DC');
            // field discharge_status type tinyInteger
            $table->tinyInteger('discharge_status');
            // field discharge_type type tinyInteger
            $table->tinyInteger('discharge_type');
            // field admit_rx_medications type text
            $table->text('admit_rx_medications');
            // field home_medications type text
            $table->text('home_medications');
            // field follow_up_instruction type mediumText
            $table->mediumText('follow_up_instruction');
            // field follow_up_schedule type mediumText
            $table->mediumText('follow_up_schedule');

            // // general_appearance
            // $table->mediumText('general_appearance');
            // // skin_exam_detail
            // $table->mediumText('skin_exam_detail');
            // // head_exam_detail
            // $table->mediumText('head_exam_detail');
            // // eyeENT_exam_detail
            // $table->mediumText('eyeENT_exam_detail');
            // // neck_exam_detail
            // $table->mediumText('neck_exam_detail');
            // // heart_exam_detail
            // $table->mediumText('heart_exam_detail');
            // // lung_exam_detail
            // $table->mediumText('lung_exam_detail');
            // // abdomen_exam_detail
            // $table->mediumText('abdomen_exam_detail');
            
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
        //
        Schema::drop('medicine_discharge_notes');
    }
}
