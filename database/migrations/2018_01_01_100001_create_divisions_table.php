<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned();
            $table->primary('id');
            $table->string('name', 120);
            $table->string('name_eng', 120);
            $table->string('name_eng_short', 60);
            $table->timestamps();
        });

        \App\Models\Lists\Division::loadData('divisions', 'create');

        // Schema::create('division_user', function (Blueprint $table) {
        //     $table->integer('user_id')->usigned();
        //     $table->smallInteger('division_id')->unsigned();
        //     $table->primary(['user_id', 'division_id']);
        // });

        // Schema::create('division_role', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->smallInteger('role_id')->usigned();
        //     $table->smallInteger('division_id')->unsigned();
        //     $table->primary(['role_id', 'division_id']);
        // });

        // Schema::create('division_role_user', function (Blueprint $table) {
        //     $table->smallInteger('division_id')->unsigned();
        //     $table->smallInteger('role_id')->unsigned();
        //     $table->integer('user_id')->usigned();
        //     $table->primary(['division_id', 'role_id', 'user_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
        // Schema::dropIfExists('division_role');
    }
}
