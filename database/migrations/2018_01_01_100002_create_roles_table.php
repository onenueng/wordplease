<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->smallInteger('id')->unsigned();
            $table->primary('id');
            $table->string('name', 120)->unique();
            $table->string('name_short', 30)->unique();
            $table->timestamps();
        });

        \App\Models\Lists\Role::loadData('roles', 'create');

        // Schema::create('role_user', function (Blueprint $table) {
        //     $table->integer('user_id')->usigned();
        //     $table->smallInteger('role_id')->unsigned();
        //     $table->primary(['user_id', 'role_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        // Schema::dropIfExists('role_user');
    }
}
