<?php

namespace Tests\Feature\Truck;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TruckControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test register.
     *
     * @return void
     */
    public function test_register()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->call('POST', '/vehicle/save', [
            'nomor_pmku' => 'CO12345',
            'nomor_npwp' => '123456789-00.123',
            'nomor_polisi' => 'B 4123 FWT',
            'merk' => 'HINO',
            'model' => 'TRUK',
            'tipe_kendaraan' => 'ST150',
            'jenis_kendaraan' => 'MB BARANG',
            'isi_silinder' => '1231',
            'kapasitas' => '1000',
            'tahun_pembuatan' => 2004,
            'nomor_stnk' => '02921412/FD',
            'masa_berlaku_pajak_kendaraan' => '26-01-2002',
            'masa_berlaku_stnk' => '28-01-2001',
            'kepala_kir' => 'ZULFAHMI',
            'nomor_kir' => 'K21391822',
            'masa_berlaku_kir' => '12-02-2002',
            'descriptions' => [
                'Foto 1',
                'Foto 2',
                'Foto 3',
                'Foto 4',
                'Foto 5',
                'Foto 6',
                'Foto 7',
                'Foto 8',
            ]
        ], [], ['photos' => [
            UploadedFile::fake()->image('foto1.jpg'),
            UploadedFile::fake()->image('foto2.jpg'),
            UploadedFile::fake()->image('foto3.jpg'),
            UploadedFile::fake()->image('foto4.jpg'),
            UploadedFile::fake()->image('foto5.jpg'),
            UploadedFile::fake()->image('foto6.jpg'),
            UploadedFile::fake()->image('foto7.jpg'),
            UploadedFile::fake()->image('foto8.jpg')
        ]]);

        $response->assertStatus(302);
    }
}
