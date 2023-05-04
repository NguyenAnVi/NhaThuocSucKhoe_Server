<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingTable extends Migration
{
    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->unsignedInteger('min_weight')->default(0);          // khoi luong toi thieu
            $table->unsignedInteger('max_weight')->nullable();          // khoi luong toi da
            $table->unsignedInteger('fee')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping');
    }
}
