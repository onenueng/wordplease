<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->usigned();
            $table->primary('id');
            $table->string('org_id'); // encrypt
            $table->string('name'); // encrypt
            $table->string('password', 64)->nullable(); // hash
            $table->string('email'); // encrypt
            $table->string('full_name', 512); // encrypt
            $table->string('full_name_eng', 512); // encrypt
            // $table->boolean('gender');
            $table->string('pln')->nullable(); // encrypt professional license number
            // $table->smallInteger('role_id')->unsigned()->default(0);
            // $table->smallInteger('division_id')->unsigned()->default(100);
            $table->boolean('email_verified')->default(false);
            $table->boolean('line_verified')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
