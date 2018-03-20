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
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('name', 80);
            $table->string('resource_name', 80);
            $table->string('view_path', 80);
            $table->tinyInteger('gender')->unsigned(); // 0 female/ 1 male/ 2 both
            $table->string('table_name', 80);
            $table->timestamps();
        });

        \App\Models\Lists\NoteType::loadData('note_types');

        Schema::create('note_type_user', function (Blueprint $table) {
            $table->smallInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->tinyInteger('note_type_id')->unsigned()->index();
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
