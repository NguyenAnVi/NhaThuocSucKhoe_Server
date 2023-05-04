<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductClassificationsTable extends Migration
{
    public function up()
    {
        Schema::create('productclassifications', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->string('name');
            $table->string('value');
            $table->string('imageurl', 2048)->nullable();
            $table->integer('stock');
            $table->integer('price');
            $table->primary(['product_id', 'name', 'value']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('productclassifications');
    }
}
