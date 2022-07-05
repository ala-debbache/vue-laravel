<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRansactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transaction', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->bigInteger('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->double('price');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_ransaction');
    }
}
