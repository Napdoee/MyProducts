<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_id')->nullable()->default(null);
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description');
            $table->string('price');
            $table->float('stock');
            $table->string('image')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};