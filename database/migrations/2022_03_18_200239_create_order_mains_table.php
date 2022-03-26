<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_mains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); // which person order this
            $table->unsignedBigInteger('vendor_id');
            $table->integer('order_id'); // generate order id
            $table->double('total_price');
            $table->double('total_point');
            $table->bigInteger('total_qty');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_paid')->default(0);
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('vendor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_mains');
    }
}
