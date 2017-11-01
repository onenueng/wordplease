<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Itemizes\Ward;

class CreateWardsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('wards', function (Blueprint $table) {
			$table->smallInteger('id')->unsigned();
			$table->primary('id');
			$table->string('name', 90)->unique();
			$table->string('name_short', 30);
			$table->boolean('active')->default(1);
			// $table->smallInteger('outsource_id')->unsigned();
			$table->timestamps();
		});
		Ward::loadcsv();
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('wards');
	}
}
