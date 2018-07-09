<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('error_logs', function (Blueprint $table) {
            $table->integer('id')->usigned();
            $table->primary('id');
            $table->string('type');
            $table->string('file');
            $table->unsignedSmallInteger('line');
            $table->unsignedSmallInteger('code');
            $table->string('message', 512);
            $table->unsignedMediumInteger('witness_id');
            $table->foreign('witness_id')->references('id')->on('users');
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
        Schema::dropIfExists('error_logs');
    }
}
