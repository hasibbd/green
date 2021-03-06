<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_product');
            $table->unsignedBigInteger('created_by');
            $table->integer('qty');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('vendor_product')->references('id')->on('vendor_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
