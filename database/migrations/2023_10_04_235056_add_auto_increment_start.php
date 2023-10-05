<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement("
        //     ALTER TABLE products AUTO_INCREMENT = 1200; 
        //     ALTER TABLE categories AUTO_INCREMENT = 2810;
        //     ALTER TABLE order_details AUTO_INCREMENT = 110;");

        DB::statement("ALTER TABLE products AUTO_INCREMENT = 1200"); 
        DB::statement("ALTER TABLE categories AUTO_INCREMENT = 2810"); 
        DB::statement("ALTER TABLE order_details AUTO_INCREMENT = 110"); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement("
        //     ALTER TABLE products AUTO_INCREMENT = 0; 
        //     ALTER TABLE categories AUTO_INCREMENT = 0;
        //     ALTER TABLE order_details AUTO_INCREMENT = 0;");

        DB::statement("ALTER TABLE products AUTO_INCREMENT = 0"); 
        DB::statement("ALTER TABLE categories AUTO_INCREMENT = 0"); 
        DB::statement("ALTER TABLE order_details AUTO_INCREMENT = 0"); 
    }
};
