<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_main_id');
            $table->unsignedBigInteger('vendor_product'); // vendor product id
            $table->unsignedBigInteger('vendor_id');
            $table->integer('qty');
            $table->float('price');
            $table->integer('point');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->foreign('vendor_product')->references('id')->on('vendor_products');
            $table->foreign('order_main_id')->references('id')->on('order_mains');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
