<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastName')->default(NULL)->nullable();
            $table->string('phone')->unique()->default(NULL)->nullable();
            $table->string('state')->default(NULL)->nullable();
            $table->string('city')->default(NULL)->nullable();
            $table->string('address')->default(NULL)->nullable();
            $table->string('building')->default(NULL)->nullable();
            $table->string('postalCode')->default(NULL)->nullable();
            $table->string('aptNumber')->default(NULL)->nullable();
            $table->string('cardExp')->default(NULL)->nullable();
            $table->string('cardNo')->default(NULL)->nullable();
        });

        /*Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });*/
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
