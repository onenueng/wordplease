<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyGeneralNotes extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('faculty_general_notes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('note_id')->unsigned()->unique();

			// field HN type integer
			$table->integer('patient_id')->unsigned();
			// $table->string('HN'); // encrypt. // replace by patient id.
			// $table->integer('HN')->unsigned();
			// // field patient_name type string
			// $table->string('patient_name', 120);
			// // field gender type boolean
			// $table->boolean('gender');
			// // field age type tinyInteger
			// $table->tinyInteger('age')->nullable();
			// field AN type integer
			// $table->integer('AN')->unsigned();
			$table->string('AN'); // encrypt.
			// field datetime_admit type date
			$table->datetime('datetime_admit')->nullable();
			// field ward_id smallInteger
			$table->smallInteger('ward_id')->unsigned()->nullable();
			// field ward_name
			// $table->string('ward_name')->nuallable();


			// field attending_id type smallInteger
			$table->smallInteger('attending_id')->unsigned()->nullable();
			// field resident_id type smallInteger
			// $table->smallInteger('resident_id')->nullable();
			// field datetime_dc type date
			$table->datetime('datetime_dc')->nullable();

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
	public function down() {
		Schema::drop('faculty_general_notes');
	}
}
