<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->integer('price');
            $table->integer('qty'); // So luong hang
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orderitems');
    }
}
