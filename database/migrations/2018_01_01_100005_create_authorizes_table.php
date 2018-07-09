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
            $table->unsignedInteger('id');
            $table->primary('id');
            $table->unsignedMediumInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedSmallInteger('permission_id')->index();
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->unsignedSmallInteger('division_id')->index();
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->date('effected_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->unsignedMediumInteger('granted_by')->index();
            $table->foreign('granted_by')->references('id')->on('users');
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
        Schema::dropIfExists('authorizes');
    }
}
