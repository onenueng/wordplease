<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Itemizes\Drug;

class CreateDrugsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('drugs', function (Blueprint $table) {
			$table->integer('id')->unsinged();
			$table->primary('id');
			$table->string('name');
			$table->string('generic_name');
			$table->string('trade_name');
			$table->string('synonym');
			$table->string('key')->nullable();
			$table->timestamps();
		});

		$success = Drug::loadcsv();
		$success = Drug::genSearchKey();
		return $success;
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
    	Schema::drop('drugs');
    }
}
