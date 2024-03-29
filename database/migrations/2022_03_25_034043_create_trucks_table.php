<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_pmku', 30);
            $table->string('nomor_npwp', 30);
            $table->string('nomor_polisi', 15);
            $table->string('merk');
            $table->string('model');
            $table->string('tipe_kendaraan');
            $table->string('jenis_kendaraan');
            $table->string('isi_silinder');
            $table->string('kapasitas');
            $table->mediumInteger('tahun_pembuatan');
            $table->string('nomor_stnk');
            $table->date('masa_berlaku_stnk');
            $table->date('masa_berlaku_pajak_kendaraan');
            $table->string('nomor_kir');
            $table->date('masa_berlaku_kir');
            $table->foreignId('id_vendor');
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
        Schema::dropIfExists('trucks');
    }
}
