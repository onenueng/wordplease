<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('sap_id', 30)->unique();
			$table->string('password', 60)->nullable();
			$table->string('name', 100)->nullable();
			$table->string('name_en', 100)->nullable();
			$table->boolean('gender')->nullable();
			$table->date('dob')->nullable();
			$table->smallInteger('division_id')->unsigned()->default(100);
			$table->tinyInteger('role_id')->nullable();
			$table->string('email')->unique();
			$table->string('licence_no', 10)->nullable();
			$table->boolean('active')->default(1);
			$table->datetime('last_notify')->default('1900-01-01 00:00:00');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('users');
	}
}
