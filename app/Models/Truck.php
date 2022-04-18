<?php

namespace App\Models;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $nama_pemilik
 * @property string $alamat_pemilik
 * @property string $nomor_polisi
 * @property string $merk
 * @property string $model
 * @property string $jenis_kendaraan
 * @property string $isi_silinder
 * @property string $kapasitas
 * @property int $tahun_pembuatan
 * @property string $nomor_stnk
 * @property string $masa_berlaku_pajak_kendaraan
 * @property string $masa_berlaku_stnk
 * @property string $kepala_kir
 * @property string $nomor_kir
 * @property string $masa_berlaku_kir
 * @property string $id_vendor
 */
class Truck extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pemilik',
        'alamat_pemilik',
        'nomor_polisi',
        'merk',
        'model',
        'jenis_kendaraan',
        'isi_silinder',
        'kapasitas',
        'tahun_pembuatan',
        'nomor_stnk',
        'masa_berlaku_pajak_kendaraan',
        'masa_berlaku_stnk',
        'kepala_kir',
        'nomor_kir',
        'masa_berlaku_kir',
        'id_vendor',
    ];

    // Relations
    public function vendor()
    {
        return $this->belongsTo(User::class, 'id_vendor');
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
