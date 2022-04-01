<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_registrasi');
            $table->string('nama', 50);
            $table->string('alamat', 100);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('no_ktp', 20);
            $table->string('no_sim', 20);
            $table->date('masa_berlaku_sim');
            $table->string('photo');
            $table->string('photo_ktp');
            $table->string('photo_sim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
