<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $nomor_registrasi
 * @property string $nama
 * @property string $alamat
 * @property string $tanggal_lahir
 * @property string $tempat_lahir  
 * @property string $no_ktp  
 * @property string $no_sim  
 * @property string $masa_berlaku_sim  
 * @property string $handphone  
 * @property string $photo  
 * @property string $photo_ktp  
 * @property string $photo_sim  
 */
class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_registrasi',
        'nama',
        'alamat',
        'tanggal_lahir',
        'tempat_lahir',
        'no_ktp',
        'no_sim',
        'masa_berlaku_sim',
        'handphone',
        'photo',
        'photo_ktp',
        'photo_sim',
    ];

    // Relations
    public function truck()
    {
        return $this->hasOne(Truck::class, 'id_driver');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($driver) {
            @Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . $driver->photo);
            @Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'idcard' . DIRECTORY_SEPARATOR . $driver->photo_ktp);
            @Storage::delete('public' . DIRECTORY_SEPARATOR . 'drivers' . DIRECTORY_SEPARATOR . 'driver_licenses' . DIRECTORY_SEPARATOR . $driver->photo_sim);
        });
    }
}
