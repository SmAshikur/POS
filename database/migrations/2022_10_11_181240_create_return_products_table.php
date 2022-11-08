<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_products', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->integer('user_id');
            $table->integer('dew_id')->nullable();
            $table->string('payment_method');
            $table->string('invoice_no')->unique();
            $table->integer('return_total');
            $table->integer('return_before')->nullable();
            $table->integer('return_pay');
            $table->integer('return_dew');
            $table->string('status')->default('1');
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
        Schema::dropIfExists('return_products');
    }
}
