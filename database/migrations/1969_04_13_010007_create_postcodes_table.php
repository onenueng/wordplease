<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Itemizes\Postcode;

class CreatePostcodesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('postcodes', function (Blueprint $table) {
      $table->mediumInteger('id');
      $table->primary('id');
      $table->mediumInteger('postcode');
      $table->mediumInteger('province_id');
      $table->string('location');
      $table->timestamps();
    });

    Postcode::loadcsv();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('postcodes');
  }
}
