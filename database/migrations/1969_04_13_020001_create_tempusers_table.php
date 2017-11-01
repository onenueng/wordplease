<?php

use App\Tempuser;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempusersTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('tempusers', function (Blueprint $table) {
			$table->increments('id');
			$table->date('dob');
			$table->string('licence_no', 10)->unique();
			$table->string('email')->unique();
			$table->smallInteger('division_id')->unsigned();            
			$table->tinyInteger('role_id');
			$table->timestamps();
		});
		// Tempuser::loadcsv();
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('tempusers');
	}
}
