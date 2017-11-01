<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelativeTypesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('relative_types', function (Blueprint $table) {
      $table->tinyInteger('id')->unsigned();
      $table->primary('id');
      $table->string('name',30)->nullable();
      // $table->string('outsource_id',5)->nullable(); removed no need to maintain outsource id.
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('relative_types');
  }
}
