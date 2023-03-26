<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('parent_id')->default((int)0);
            $table->text('detail')->nullable();
            $table->text('imageurl')->nullable();
            $table->integer('status')->default(1);
        });
    }
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}