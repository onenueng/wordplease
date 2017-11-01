<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObgynLabourNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('obgyn_labour_notes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('note_id')->unsigned()->unique(); // relation on notes.
			// $table->integer('patient_id')->unsigned(); // relation on patients.
			// $table->datetime('datetime_admit')->nullable();
			// $table->smallInteger('ward_id')->unsigned()->default(0); // relation on wards.
			// $table->smallInteger('attending_id')->unsigned()->default(0); // relation on attending_staffs.
			// $table->datetime('datetime_dc')->nullable();
			// $table->integer('creator_id')->unsigned(); // relation on users.
			// $table->integer('updater_id')->unsigned(); // relation on users.
			// $table->timestamps();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('obgyn_labour_notes');
	}
}
