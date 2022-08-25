<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //populate products
        DB::table('products')->insert([
            ['name' => 'Intel Xeon 2066 4.2Ghz', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/CPUs/xeon2066.jpg', 'price' => 2359.99, 'inStock' => 5, 'categoryID' => '2', 'brand' => 'INTEL', 'vm_size' => 24],
            ['name' => 'Intel core i9 10900k', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/CPUs/10900k.jpg', 'price' => 499.99, 'inStock' => 0, 'categoryID' => '2', 'brand' => 'INTEL', 'vm_size' => 12],
            ['name' => 'Intel core i9 9900k', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/CPUs/9900k.jpg', 'price' => 459.99, 'inStock' => 1, 'categoryID' => '2', 'brand' => 'INTEL', 'vm_size' => 5],
            ['name' => 'Samsung 970Evo 2TB NVME', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/SSDs/970evo2TB.png', 'price' => 150.99, 'inStock' => 55, 'categoryID' => '3', 'brand' => 'SAMSUNG', 'vm_size' => 0],
            ['name' => 'Adata SU-800 512GB', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/SSDs/su800512gb.jpg', 'price' => 69.99, 'inStock' => 55, 'categoryID' => '3', 'brand' => 'ADATA', 'vm_size' => 0],
            ['name' => 'Innosilicon A10Pro 720mh', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/ASICs/innosiliconA10pro.png', 'price' => 25999.99, 'inStock' => 55, 'categoryID' => '4', 'brand' => 'INNOSILICON', 'vm_size' => 0],
            ['name' => 'Goldshell miner - Vosk edition', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/ASICs/goldShellMiner.png', 'price' => 579.99, 'inStock' => 55, 'categoryID' => '4', 'brand' => 'GOLDSHELL', 'vm_size' => 0],
            ['name' => 'Antminer L3+ Scrypt miner', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/ASICs/l3Plus.png', 'price' => 999.99, 'inStock' => 55, 'categoryID' => '4', 'brand' => 'BITMAIN', 'vm_size' => 0]
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
    }
}
