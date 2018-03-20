<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendingStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attending_staffs', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned();
            $table->primary('id');
            $table->string('name', 160)->unique();
            $table->smallInteger('division_id')->unsigned()->default(100); // set default to Hospital.
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('licence_no', 10)->unique();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        \App\Models\Lists\AttendingStaff::loadData('attending_staffs', 'create');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attending_staffs');
    }
}
