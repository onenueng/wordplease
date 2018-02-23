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
            $table->integer('user_id')->usigned()->index();
            $table->smallInteger('permission_id')->usigned()->index();
            $table->smallInteger('division_id')->unsigned()->index();
            $table->date('valid_until')->nullable();
            $table->integer('granted_by')->usigned()->index();
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
