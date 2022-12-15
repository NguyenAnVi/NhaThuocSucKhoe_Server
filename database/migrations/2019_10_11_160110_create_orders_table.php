<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('address');
            $table->integer('weight')->default('1000');
            $table->string('shipping_method');
            $table->integer('shipping_fee');
            $table->string('payment_method');
            $table->integer('subtotal');        //tien hang
            $table->integer('total_discount');  //tien KM: tong tien discount cho moi san pham
            $table->integer('total');           //tong tien thanh toan = tien hang + tien ship - tien KM...
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
