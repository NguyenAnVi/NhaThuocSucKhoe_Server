<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativeUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('administrative_units', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();         // Ten donvi day du (Tieng Viet)
            $table->string('full_name_en')->nullable();      // .................(Tieng Anh)
            $table->string('short_name')->nullable();        // Ten donvi ngan gon (Tieng Anh)
            $table->string('short_name_en')->nullable();     // ...................(Tieng Anh)
            $table->string('code_name')->nullable();         // Ma donvi (Tieng Viet)
            $table->string('code_name_en')->nullable();      // .........(Tieng Anh)
        });
    }
    public function down()
    {
        Schema::dropIfExists('administrative_units');
    }
}
