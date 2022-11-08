<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnBacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_backs', function (Blueprint $table) {
            $table->id();
            $table->integer('inv_id');
            $table->integer('return_id');
            $table->integer('purchase_id')->nullable();
            $table->integer('product_id');
            $table->integer('price');
            $table->integer('return_price');
            $table->integer('total_price');
            $table->integer('qty');
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
        Schema::dropIfExists('return_backs');
    }
}
