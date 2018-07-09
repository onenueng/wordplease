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
            $table->unsignedTinyInteger('id');
            $table->primary('id');
            $table->unsignedTinyInteger('class'); // admission/discharge/service.
            $table->unsignedSmallInteger('division_id'); // relation on division.
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('name', 80);
            $table->string('class_path', 80);
            $table->string('view_path', 80);
            $table->unsignedTinyInteger('gender'); // 0 female/ 1 male/ 2 both
            $table->string('table_name', 80);
            $table->timestamps();
        });

        Schema::create('note_type_user', function (Blueprint $table) {
            $table->unsignedMediumInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedTinyInteger('note_type_id')->index();
            $table->foreign('note_type_id')->references('id')->on('note_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_type_user');
        Schema::dropIfExists('note_types');
    }
}
