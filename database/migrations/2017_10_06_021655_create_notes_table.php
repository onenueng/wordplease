<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('an');
            $table->dateTime('datetime_admit')->nullable();
            $table->dateTime('datetime_discharge')->nullable();
            $table->smallInteger('ward_id')->unsigned()->index();
            $table->smallInteger('attending_staff_id')->unsigned()->index();
            $table->smallInteger('division_id')->unsigned()->index();
            $table->string('mini_hash', 7)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
