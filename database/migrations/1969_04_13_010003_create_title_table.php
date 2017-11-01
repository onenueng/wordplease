<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Itemizes\Title;

class CreateTitleTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('title', function (Blueprint $table) {
      $table->smallInteger('id');
      $table->primary('id');
      $table->string('name', 50);
      // $table->string('outsource_id', 5); removed no need to maintain outsource id.
      // $table->boolean('is_title'); // title or prefix.
      $table->timestamps();
    });
    // Title::loadcsv(); // no need to init title data.
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('title');
  }
}
