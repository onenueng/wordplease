<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Itemizes\Province;

class CreateProvincesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('provinces', function (Blueprint $table) {
      $table->mediumInteger('id');
      $table->primary('id');
      $table->tinyInteger('region');
      $table->string('province', 80);
      $table->timestamps();
    });

    Province::loadcsv();
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('provinces');
  }
}
