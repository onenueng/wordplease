<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExceptionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exception_logs', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->primary('id');
            $table->string('route');
            $table->string('type');
            $table->string('file');
            $table->unsignedSmallInteger('line');
            $table->unsignedSmallInteger('code');
            $table->string('message', 512);
            $table->unsignedMediumInteger('witness_id')->nullable();
            $table->foreign('witness_id')->references('id')->on('users');
            $table->timestamps(3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exception_logs');
    }
}
