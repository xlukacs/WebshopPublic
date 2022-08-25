<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixInserting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('category_groups')->truncate();
        DB::table('products')->truncate();
        DB::table('category_groups')->insert([
            ['name' => 'GPUs', 'picture' => '/icons/gpuIcon.png'],
            ['name' => 'CPUs', 'picture' => '/icons/cpuIcon.png'],
            ['name' => 'SSDs', 'picture' => '/icons/ssdIcon.png'],
            ['name' => 'ASICs', 'picture' => '/icons/asicIcon.png']
        ]);
        //populate products
        DB::table('products')->insert([
            ['name' => 'RTX 3090 Founders Edition 24GB', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/GPUs/3090FE.jpg,/GPUs/2080tiFE.jpg', 'price' => 2229.99, 'inStock' => 5, 'categoryID' => '1', 'brand' => 'NVIDIA', 'vm_size' => 24],
            ['name' => 'AMD R7 5800x 8 core 16 thread', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/CPUs/r7_5800x.png', 'price' => 359.99, 'inStock' => 0, 'categoryID' => '2', 'brand' => 'INTEL', 'vm_size' => 12],
            ['name' => 'Kingston A400 240GB', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/SSDs/kingstonA400_240gb.png', 'price' => 27.99, 'inStock' => 1, 'categoryID' => '3', 'brand' => 'AMD', 'vm_size' => 5],
            ['name' => 'Bitmain Antminer S19 XP 140TH', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/ASICs/antminers19xp.jpg', 'price' => 19999.99, 'inStock' => 55, 'categoryID' => '4', 'brand' => 'BITMAIN', 'vm_size' => 0]
        ]);
        //populate default test user
        DB::table('users')->insert([
            ['name' => 'test', 'email' => 'test@test.com', 'password' => '$2y$10$53PB1.B1KpX36AiTsZTy3OH89WBrYu4c5lUS2ol87NeFkE4mcf.Ri'] //name:test,password:testpassword
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('products')->truncate();
        DB::table('category_groups')->truncate();
    }
}
