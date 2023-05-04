<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('productshippingmethods', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('shipping_id');
            $table->foreign('shipping_id')->references('id')->on('shipping');
            $table->primary(['product_id','shipping_id']);
            $table->integer('voucher')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('productshippingmethods');
    }
}
