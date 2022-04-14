<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $nomor_pmku
 * @property string $nomor_npwp
 * @property string $nomor_polisi
 * @property string $merk
 * @property string $model
 * @property string $tipe_kendaraan
 * @property string $jenis_kendaraan
 * @property string $isi_silinder
 * @property string $kapasitas
 * @property int $tahun_pembuatan
 * @property string $nomor_rangka
 * @property string $nomor_mesin
 * @property string $warna_tnkb
 * @property string $bahan_bakar
 * @property int $tahun_registrasi
 * @property string $nama_pemilik
 * @property string $alamat_pemilik
 * @property string $nomor_stnk
 * @property string $masa_berlaku_pajak_kendaraan
 * @property string $kode_lokasi_pada_stnk
 * @property string $masa_berlaku_stnk
 * @property string $kepala_kir
 * @property string $nomor_kir
 * @property string $masa_berlaku_kir
 * @property string $id_vendor
 * @property string $id_driver
 */
class Truck extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_pmku',
        'nomor_npwp',
        'nomor_polisi',
        'merk',
        'model',
        'tipe_kendaraan',
        'jenis_kendaraan',
        'isi_silinder',
        'kapasitas',
        'tahun_pembuatan',
        'nomor_rangka',
        'nomor_mesin',
        'warna_tnkb',
        'bahan_bakar',
        'tahun_registrasi',
        'nama_pemilik',
        'alamat_pemilik',
        'nomor_stnk',
        'masa_berlaku_pajak_kendaraan',
        'kode_lokasi_pada_stnk',
        'masa_berlaku_stnk',
        'kepala_kir',
        'nomor_kir',
        'masa_berlaku_kir',
        'id_vendor',
        'id_driver',
    ];

    // Relations
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor');
    }

    public function driver()
    {
        return $this->belongsTo(Supir::class, 'id_driver');
    }

    public function photos()
    {
        return $this->hasMany(TruckPhotos::class, 'id_truck');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::deleted(function ($truck) {
            foreach ($truck->photos as $photo) {
                Storage::delete('public' . DIRECTORY_SEPARATOR . 'trucks' . DIRECTORY_SEPARATOR . $photo->filename);
            }

            $truck->photos()->delete();
        });
    }
}
