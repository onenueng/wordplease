<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\MockupWard;

class CreateMockupWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mockup_wards', function (Blueprint $table) {
            $table->increments('id');
            // $table->primary('id');
            $table->string('name', 120);
            $table->string('name_short', 30);
            $table->timestamps();
        });
        MockupWard::loadcsv();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mockup_wards');
    }
}
