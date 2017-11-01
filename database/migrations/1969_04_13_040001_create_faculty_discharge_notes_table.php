<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyDischargeNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('faculty_discharge_notes', function (Blueprint $table) {
			$table->integer('id');
			$table->primary('id'); // relation on notes.
			 // field encounter_type type TinyInteger.
			$table->tinyInteger('encounter_type')->unsigned()->nullable();
			 // field principle_diagnosis type string.
			$table->string('principle_diagnosis')->nullable();
			 // field complications type text.
			$table->text('complications')->nullable();
			 // field operations_procedures type text.
			$table->text('operations_procedures')->nullable();
			 // field discharge_status type tinyInteger.
			$table->tinyInteger('discharge_status')->unsigned()->nullable();
			 // field discharge_type type tinyInteger.
			$table->tinyInteger('discharge_type')->unsigned()->nullable();
			 // field autopsy type tinyInteger.
			$table->tinyInteger('autopsy')->unsigned()->nullable();
			 // field treatment_result_detail type text.
			$table->text('treatment_result_detail')->nullable();
			 // field history type text.
			$table->text('history')->nullable();
			 // field history_examination type text.
			$table->text('history_examination')->nullable();
			 // field history_investigation type text.
			$table->text('history_investigation')->nullable();
			 // field prognosis type text.
			$table->text('prognosis')->nullable();
			 // field date_appointment type date.
			$table->date('date_appointment')->nullable();
			 // field appointment_clinic_id type smallInt.
			$table->smallInteger('appointment_clinic_id')->nullable();
			 // field appointment_clinic_name type string.
			$table->string('appointment_clinic_name')->nullable();
			 // field appointment_note type string.
			$table->string('appointment_note')->nullable();
			 // field home_medications type text.
			$table->text('home_medications')->nullable();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('faculty_discharge_notes');
	}
}
