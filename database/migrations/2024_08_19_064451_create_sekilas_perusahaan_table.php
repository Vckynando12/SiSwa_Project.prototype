<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekilasPerusahaanTable extends Migration
{
    public function up()
    {
        Schema::create('sekilas_perusahaan', function (Blueprint $table) {
            $table->id('Id_sekilas');
            $table->text('maintext');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekilas_perusahaan');
    }
}
