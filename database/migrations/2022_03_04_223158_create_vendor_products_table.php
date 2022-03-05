<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product');
            $table->float('vendor_price');
            $table->float('sell_price');
            $table->integer('point');
            $table->unsignedBigInteger('created_by');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('product')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('vendor_products');
        Schema::dropIfExists('products');
    }
}
