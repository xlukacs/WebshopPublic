<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixBrandingForProductFilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //populate products
        DB::table('products')->where('name', '=', 'AMD R7 5800x 8 core 16 thread')->update(['brand' => "AMD"]);
        DB::table('products')->where('name', '=', 'Kingston A400 240GB')->update(['brand' => "KINGSTON"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
