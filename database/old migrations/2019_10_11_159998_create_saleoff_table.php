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
            $table->string('contenturl')->default('');
            $table->datetime('starttime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('endtime')->nullable();
            $table->string('imageurl')->default('');
            $table->integer('status')->default(1);

        });
    }
    public function down()
    {
        Schema::dropIfExists('saleoffs');
    }
}
