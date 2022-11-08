<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solds', function (Blueprint $table) {
            $table->id();
            $table->integer('inv_id');
            $table->integer('sell_id');
            $table->integer('product_id');
            $table->integer('purchases_id')->nullable();
            $table->integer('qty');
            $table->integer('discount');
            $table->integer('price');
            $table->integer('sold_price');
            $table->integer('total_price');
            $table->integer('per_profit')->nullable();
            $table->integer('total_profit')->nullable();
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
        Schema::dropIfExists('solds');
    }
}
