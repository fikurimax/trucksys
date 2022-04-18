<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TruckTableChanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trucks', function (Blueprint $table) {
            $table->dropColumn('nomor_pmku');
            $table->dropColumn('nomor_npwp');
            $table->dropColumn('tipe_kendaraan');
            $table->addColumn('string', 'nama_pemilik', [
                'length'    => 199
            ])->first();
            $table->addColumn('text', 'alamat_pemilik')->after('nama_pemilik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trucks', function (Blueprint $table) {
            $table->addColumn('string', 'nomor_pmku', [
                'length' => 199
            ])->first();
            $table->addColumn('string', 'nomor_npwp', [
                'length' => 199
            ])->after('nomor_pmku');
            $table->addColumn('string', 'tipe_kendaraan', [
                'length' => 199
            ])->after('model');
            $table->dropColumn('nama_pemilik');
            $table->dropColumn('alamat_pemilik');
        });
    }
}
