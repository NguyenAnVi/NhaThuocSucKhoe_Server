<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativeRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('administrative_regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // Ten khu vuc (Tieng Viet)
            $table->string('name_en');                  // ............(Tieng Anh)
            $table->string('code_name')->nullable();    // Ma khu vuc (Tieng Viet)
            $table->string('code_name_en')->nullable(); // ...........(Tieng Anh)
        });
    }
    public function down()
    {
        Schema::dropIfExists('administrative_regions');
    }
}
