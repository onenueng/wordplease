<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\IPDNote\NoteType;

class CreateNoteTypesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('note_types', function (Blueprint $table) {
			$table->smallInteger('id')->unsigned();
			$table->primary('id');
			$table->tinyInteger('class_id')->unsigned(); // admission/discharge/service.
			$table->smallInteger('owner_id')->unsigned(); // relation on division.
			$table->string('name');
			$table->string('resource_name');
			$table->string('view_path');
			$table->tinyInteger('gender')->unsigned();
			$table->timestamps();
		});

		NoteType::loadcsv();
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('note_types');
	}
}
