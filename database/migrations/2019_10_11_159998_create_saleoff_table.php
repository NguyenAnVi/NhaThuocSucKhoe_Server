<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSaleoffTable extends Migration
{
    public function up()
    {
        Schema::create('saleoffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('percent')->default(0);
            $table->integer('amount')->default(0);
            $table->datetime('starttime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('endtime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('imageurl')->default('');
        });
    }
    public function down()
    {
        Schema::dropIfExists('saleoffs');
    }
}
