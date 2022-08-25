<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default("user");
        });
        //populate default test user
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@test.com', 'password' => '$2y$10$53PB1.B1KpX36AiTsZTy3OH89WBrYu4c5lUS2ol87NeFkE4mcf.Ri','role' => 'admin'] //name:test,password:testpassword
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        DB::table('users')->truncate();
    }
}
