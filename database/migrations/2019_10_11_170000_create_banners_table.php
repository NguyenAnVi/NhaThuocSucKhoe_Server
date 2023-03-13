<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('link')->default('');
            $table->string('imageurl', 2048)->default('');
            $table->string('status')->default('ACTIVE');
        });
    }
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
