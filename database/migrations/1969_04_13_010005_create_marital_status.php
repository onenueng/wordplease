<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaritalStatus extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('marital_status', function (Blueprint $table) {
      $table->tinyInteger('id')->unsigned();
      $table->primary('id');
      $table->string('name',30);
      // $table->tinyInteger('outsource_id'); removed no need to maintain outsource id.
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(){
    Schema::drop('marital_status');
  }
}
