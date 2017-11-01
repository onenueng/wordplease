<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Itemizes\AttendingStaff;

class CreateAttendingStaffsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('attending_staffs', function (Blueprint $table) {
			$table->smallInteger('id')->unsigned();
			$table->primary('id');
			$table->string('name', 120);
			$table->smallInteger('division_id')->unsigned()->default(100); // default Faculty.
			$table->string('licence_no', 10)->unique();
			$table->boolean('active')->default(1);
			$table->timestamps();
		});
		AttendingStaff::loadcsv();
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('attending_staffs');
	}
}
