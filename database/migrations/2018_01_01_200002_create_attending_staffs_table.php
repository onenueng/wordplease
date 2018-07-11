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
            $table->unsignedSmallInteger('id');
            $table->primary('id');
            $table->string('name', 160)->unique();
            $table->unsignedSmallInteger('division_id')->default(100); // set default to Hospital.
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('licence_no', 10)->unique();
            $table->boolean('active')->default(1);
            $table->timestamps(3);
        });
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
