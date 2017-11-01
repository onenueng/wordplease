<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('notes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('AN'); // encrypt.
			$table->integer('patient_id')->unsigned(); // relation on patients.
			$table->index('patient_id');
			$table->smallInteger('division_id')->unsigned()->default(100); // relation on divsion.
			$table->index('division_id');
			$table->string('division_name', 120)->nullable(); // in case out of items list.
			$table->tinyInteger('note_type_id')->unsigned()->default(0);
			$table->index('note_type_id');
			$table->datetime('datetime_admit')->nullable();
			$table->smallInteger('ward_id')->unsigned()->default(0); // relation on wards.
			$table->string('ward_name', 120)->nullable(); // in case out of items list.
			$table->smallInteger('attending_id')->unsigned()->default(0); // relation on attending_staffs.
			$table->string('attending_name', 120)->nullable(); // in case out of items list.
			$table->datetime('datetime_dc')->nullable();
			$table->tinyInteger('status')->unsigned()->default(0); // edit/publised/override.
			$table->index('status');
			$table->smallInteger('field_nailed_no')->unsigned()->nullable();
			$table->smallInteger('field_need_no')->unsigned()->nullable();
			$table->text('md_note')->nullable();
			$table->integer('creator_id')->unsigned()->default(0); // relation on users.
			$table->integer('updater_id')->unsigned()->default(0); // relation on users.
			$table->timestamps();
			$table->softDeletes();
			$table->string('cat_code', 8);
			$table->index('cat_code');
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('notes');
	}
}
