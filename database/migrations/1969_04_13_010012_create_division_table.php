<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Itemizes\Division;

class CreateDivisionTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('division', function (Blueprint $table) {
			$table->smallInteger('id')->unsigned();
			$table->primary('id');
			$table->string('name', 120);
			$table->string('name_eng', 120);
			$table->string('name_eng_short', 60);
			$table->integer('outsource_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Division::loadcsv();
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('division');
	}
}
