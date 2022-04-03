<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nama_perusahaan
 * @property string $nama_pemilik
 * @property string $alamat
 * @property string $kontak
 * @property integer $npwp
 */
class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_perusahaan', 'nama_pemilik', 'alamat', 'kontak', 'npwp'
    ];

    // Relations
    public function trucks()
    {
        return $this->hasMany(Truck::class, 'id_vendor');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($vendor) {
            $vendor->vendor()->delete();
        });
    }
}
