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
            $table->integer('price')->default(0);
            $table->text('images');
            $table->unsignedBigInteger('saleoff_id')->nullable();
            $table->foreign('saleoff_id')->references('id')->on('saleoffs');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('sold')->unsigned()->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
