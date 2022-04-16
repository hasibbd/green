<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('b_date');
            $table->string('f_name');
            $table->string('m_name');
            $table->tinyInteger('gender');
            $table->bigInteger('l_license')->nullable();
            $table->date('l_date')->nullable();
            $table->string('district');
            $table->string('p_station');
            $table->integer('p_code');
            $table->string('occupation');
            $table->string('qualification');
            $table->string('n_name');
            $table->date('n_b_date');
            $table->string('relation');
            $table->bigInteger('n_nid');
            $table->string('r_name');
            $table->bigInteger('r_code');
            $table->string('a_name');
            $table->string('b_name');
            $table->string('branch');
            $table->bigInteger('acc');
            $table->integer('created_by');
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_information');
    }
}
