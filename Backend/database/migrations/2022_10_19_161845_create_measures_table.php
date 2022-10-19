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
        Schema::create('measures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('shoulder')->nullable();
            $table->float('length_sleeve')->nullable();
            $table->float('round_sleeve')->nullable();
            $table->float('chest')->nullable();
            $table->float('length_dress')->nullable();
            $table->float('neckline')->nullable();
            $table->float('middle_front')->nullable();
            $table->float('broad_back')->nullable();
            $table->float('breast_gap')->nullable();
            $table->float('waist_size')->nullable();
            $table->float('waist_circumference')->nullable();
            $table->float('buttock_circumference')->nullable();
            $table->float('chest_height')->nullable();
            $table->float('length_waist')->nullable();
            $table->float('bodice_length')->nullable();
            $table->float('dress_length')->nullable();
            $table->float('knee_length')->nullable();
            $table->float('skirt_length')->nullable();
            $table->float('pants_length')->nullable();
            $table->float('thighs')->nullable();
            $table->float('knee_circumference')->nullable();
            $table->float('down')->nullable();
            $table->uuid('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measures');
    }
};
