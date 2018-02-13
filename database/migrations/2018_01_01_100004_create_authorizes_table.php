<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorizes', function (Blueprint $table) {
            $table->integer('id')->usigned();
            $table->primary('id');
            $table->smallInteger('role_id')->usigned();
            $table->smallInteger('division_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('authorize_user', function (Blueprint $table) {
            $table->integer('authorize_id')->usigned();
            $table->integer('user_id')->usigned();
            $table->primary(['user_id', 'authorize_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorizes');
        Schema::dropIfExists('authorize_user');
    }
}
