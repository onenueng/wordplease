<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckUsersTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('check_users', function (Blueprint $table) {
			$table->increments('id');
			$table->string("return_code")->nullable();
			$table->string("pid")->nullable();
			$table->string("userid")->nullable();
			$table->string("username")->nullable();
			$table->string("remark")->nullable();
			$table->string("job_key")->nullable();
			$table->string("job_key_desc")->nullable();
			$table->string("org_unit_m")->nullable();
			$table->string("org_unit_m_desc")->nullable();
			$table->string("connect_email")->nullable();
			$table->string("Name_EN")->nullable();
			$table->string("tel_no")->nullable();
			$table->string("useable_status")->nullable();
			$table->timestamps();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
	Schema::drop('check_users');
	}
}
