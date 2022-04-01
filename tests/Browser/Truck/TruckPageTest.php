<?php

namespace Tests\Browser\Truck;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TruckPageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->markTestSkipped("Skipped because too lazy lol");

        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();

            $browser->loginAs($user)
                ->visit('/vehicle/registration')
                ->type('nomor_pmku', 'nomor_pmku')
                ->type('nomor_npwp', 'nomor_npwp')
                ->type('nomor_polisi', 'nomor_polisi')
                ->type('merk', 'merk')
                ->type('model', 'model')
                ->type('tipe_kendaraan', 'tipe_kendaraan')
                ->type('jenis_kendaraan', 'jenis_kendaraan')
                ->type('isi_silinder', 'isi_silinder')
                ->type('kapasitas', 'kapasitas')
                ->type('tahun_pembuatan', 'tahun_pembuatan')
                ->type('nomor_rangka', 'nomor_rangka')
                ->type('nomor_mesin', 'nomor_mesin')
                ->type('warna_tnkb', 'warna_tnkb')
                ->type('bahan_bakar', 'bahan_bakar')
                ->type('tahun_registrasi', 'tahun_registrasi')
                ->type('nama_pemilik', 'nama_pemilik')
                ->type('alamat_pemilik', 'alamat_pemilik')
                ->type('nomor_stnk', 'nomor_stnk')
                ->type('masa_berlaku_pajak_kendaraan', 'masa_berlaku_pajak_kendaraan')
                ->type('kode_lokasi_pada_stnk', 'kode_lokasi_pada_stnk')
                ->type('masa_berlaku_stnk', 'masa_berlaku_stnk')
                ->type('kepala_kir', 'kepala_kir')
                ->type('nomor_kir', 'nomor_kir')
                ->type('masa_berlaku_kir', 'masa_berlaku_kir')
                ->type('id_vendor', 'id_vendor')
                ->type('id_driver', 'id_driver');
        });
    }
}
