<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('reciver_id')->nullable();
            //$table->integer('trans_id')->nullable();
            $table->integer('transication_id');
            $table->string('dew_type');
            $table->string('dew_in')->nullable();
            $table->integer('amount');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('dews');
    }
}
