<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHotProductsToDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('products')->insert([
            ['name' => 'RX 6600XT 8GB', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/GPUs/hellhoundRX6600xt.png', 'price' => 359.99, 'inStock' => 5, 'categoryID' => '1', 'brand' => 'AMD', 'vm_size' => 8],
            ['name' => 'RTX 2080TI Founders Edition 16GB', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/GPUs/2080tiFE.jpg', 'price' => 899.99, 'inStock' => 0, 'categoryID' => '1', 'brand' => 'NVIDIA', 'vm_size' => 16],
            ['name' => 'RTX A6000 48GB', 'description' => 'Lorem ipsom dolor sit amet', 'pictures' => '/GPUs/A6000.jpg', 'price' => 4599.99, 'inStock' => 1, 'categoryID' => '1', 'brand' => 'NVIDIA', 'vm_size' => 48]
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
