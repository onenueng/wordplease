<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceNationTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('race_nation', function (Blueprint $table) {
      $table->tinyInteger('id')->unsigned();
      $table->primary('id');
      $table->string('name',30);
      // $table->string('outsource_id',5); removed no need to maintain outsource id.
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('race_nation');
  }
}
