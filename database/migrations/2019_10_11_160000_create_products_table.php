<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->boolean('classified')->default(false);
            $table->string('price')->default("")->nullable();
            $table->text('images')->default("");
            $table->integer('weight')->default(1000);   // Can nang (don vi: gram)
            $table->integer('saleoff_price')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('stock')->default(0);
            $table->integer('sold')->default(0);
            $table->string('status')->default('ACTIVE');

        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
