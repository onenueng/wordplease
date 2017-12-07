<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_types', function (Blueprint $table) {
            $table->tinyInteger('id')->unsigned();
            $table->primary('id');
            $table->tinyInteger('class')->unsigned(); // admission/discharge/service.
            $table->smallInteger('division_id')->unsigned(); // relation on division.
            $table->string('name');
            $table->string('resource_name');
            $table->string('view_path');
            $table->tinyInteger('gender')->unsigned(); // 0 female/ 1 male/ 2 both
            $table->string('table_name');
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
        Schema::dropIfExists('note_types');
    }
}
