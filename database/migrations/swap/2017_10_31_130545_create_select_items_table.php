<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select_items', function (Blueprint $table) {
            $table->string('field_name', 80)->index();
            $table->tinyInteger('value')->unsigned();
            $table->string('label', 120)->index();
            $table->primary(['field_name', 'value', 'label']);
            $table->tinyInteger('order')->unsigned();
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('select_items');
    }
}
