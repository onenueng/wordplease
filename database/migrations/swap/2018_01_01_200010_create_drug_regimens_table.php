<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugRegimensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_regimens', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->primary('id');
            $table->unsignedInteger('drug_id')->index();
            $table->foreign('drug_id')->references('id')->on('drugs');
            $table->string('name', 90)->unique();
            $table->unsignedInteger('frequency')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('drug_regimens');
    }
}
