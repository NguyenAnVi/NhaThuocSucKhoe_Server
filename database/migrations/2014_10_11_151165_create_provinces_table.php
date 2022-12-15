<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->string('code',20)->primary();
            $table->string('name');                                 // Ten tinh (Tieng Viet)
            $table->string('name_en')->nullable();                  // .........(Tieng Anh)
            $table->string('full_name');                             // Ten tinh day du (Tieng Viet)
            $table->string('full_name_en')->nullable();             // ................(Tieng Anh)
            $table->string('code_name')->nullable();                // Ma tinh (Tieng Viet)
            $table->unsignedBigInteger('administrative_unit_id')->nullable();   // Donvi hanh chinh
            $table->foreign('administrative_unit_id')->references('id')->on('administrative_units');
            $table->unsignedBigInteger('administrative_region_id')->nullable(); // Khuvuc hanh chinh
            $table->foreign('administrative_region_id')->references('id')->on('administrative_regions');

        });
    }
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
