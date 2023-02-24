<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsTable extends Migration
{
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->string('code',20)->primary();
            $table->string('name');                                 // Ten xa day du (Tieng Viet)
            $table->string('name_en')->nullable();                  // .................(Tieng Anh)
            $table->string('full_name')->nullable();                 // Ten xa day du (Tieng Viet)
            $table->string('full_name_en')->nullable();             // .................(Tieng Anh)
            $table->string('code_name',20)->nullable();                // Ma xa (Tieng Viet)
            $table->unsignedBigInteger('administrative_unit_id')->nullable();   // madonvihanhchinh
            $table->foreign('administrative_unit_id')->references('id')->on('administrative_units');
            $table->string('district_code',20)->nullable();           // ma huyen
            $table->foreign('district_code')->references('code')->on('districts');
        });
    }
    public function down()
    {
        Schema::dropIfExists('wards');
    }
}
