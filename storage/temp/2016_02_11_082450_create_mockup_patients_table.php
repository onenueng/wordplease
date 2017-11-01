<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\MockupPatient;

class CreateMockupPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mockup_patients', function (Blueprint $table) {
            $table->integer('id');
            $table->primary('id');
            $table->integer('HN')->unique()->unsigned();
            $table->string('name', 120);
            $table->date('dob')->nullable();
            $table->boolean('gender');
            $table->timestamps();
        });
        MockupPatient::loadcsv();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mockup_patients');
    }
}
