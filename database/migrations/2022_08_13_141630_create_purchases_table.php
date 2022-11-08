<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->integer('user_id');
            $table->integer('dew_id')->nullable();
            $table->string('payment_method');
            $table->string('invoice_no')->unique();
            $table->integer('grand_total');
            $table->integer('grand_dis');
            $table->integer('grand_before');
            $table->integer('grand_pay');
            $table->integer('grand_dew')->default(0);
            $table->string('status')->default('0');
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
        Schema::dropIfExists('purchases');
    }
}
