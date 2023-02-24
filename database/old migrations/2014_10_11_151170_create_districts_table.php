<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->string('code',20)->primary();
            $table->string('name');                                 // Ten huyen day du (Tieng Viet)
            $table->string('name_en')->nullable();                  // .................(Tieng Anh)
            $table->string('full_name')->nullable();                 // Ten huyen day du (Tieng Viet)
            $table->string('full_name_en')->nullable();             // .................(Tieng Anh)
            $table->string('code_name')->nullable();                // Ma huyen (Tieng Viet)
            $table->unsignedBigInteger('administrative_unit_id')->nullable();   // madonvihanhchinh
            $table->foreign('administrative_unit_id')->references('id')->on('administrative_units');
            $table->string('province_code',20)->nullable();           // ma tinhthanh
            $table->foreign('province_code')->references('code')->on('provinces');
        });
    }
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
