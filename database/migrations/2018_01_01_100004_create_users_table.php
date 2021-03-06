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
            $table->unsignedMediumInteger('id');
            $table->primary('id');
            $table->string('org_id'); // encrypt
            $table->string('name'); // encrypt
            $table->string('password', 64)->nullable(); // hash
            $table->string('email'); // encrypt
            $table->string('full_name', 512); // encrypt
            $table->string('full_name_en', 512); // encrypt
            $table->unsignedSmallInteger('division_id')->index()->default(config('constant.DEFAULT_USER_DIVISION_ID')); // default Faculty
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->string('pln')->nullable(); // encrypt professional license number
            $table->string('dashboard')->default('profile');
            $table->string('verify_code', config('constant.VERIFY_CODE_LENGTH'));
            $table->boolean('email_verified')->default(false);
            $table->boolean('line_verified')->default(false);
            $table->date('expiry_date')->nullable();
            $table->timestamp('last_seen', 3)->nullable();
            $table->string('mini_hash', config('constant.MINI_HASH_LENGTH'));
            $table->rememberToken();
            $table->timestamps(3);
        });

        // App\User::create([
        //               'id' => 1,
        //              'pln' => null,
        //             'name' => 'wordplease',
        //            'email' => 'wordplease',
        //           'org_id' => 'wordplease',
        //         'password' => str_random(12),
        //        'full_name' => 'เวิร์ดพลีส',
        //     'full_name_en' => 'wordplease',
        // ]);
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
