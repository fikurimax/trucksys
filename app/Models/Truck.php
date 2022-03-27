<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nomor_polisi
 * @property int $tahun_pembuatan
 * @property string $berat_kosong
 * @property string $jenis
 * @property integer $id_vendor
 * @property integer $id_driver
 */
class Truck extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_polisi', 'tahun_pembuatan', 'berat_kosong', 'jenis', 'id_vendor',
        'id_driver'
    ];

    /**
     * Create table data proxy for translating columns name
     * if the column's name is not English. Also this is required
     * to avoid direct contact with the database property which is quite
     * risky due to changes, so services can use this proxy instead
     * of property itself
     *
     * @var array
     */
    protected $appends = [
        'plate_number', 'year_made', 'weight_empty', 'type'
    ];

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    public function getPlateNumberAttribute()
    {
        return $this->attributes['nomor_polisi'];
    }

    public function setPlateNumberAttribute(string $plateNumber)
    {
        $this->attributes['nomor_polisi'] = $plateNumber;
    }

    public function getYearMadeAttribute()
    {
        return $this->attributes['tahun_pembuatan'];
    }

    public function setYearMadeAttribute(int $year = 0)
    {
        $this->attributes['tahun_pembuatan'] = $year;
    }

    public function getWeightEmptyAttribute()
    {
        return $this->attributes['berat_kosong'];
    }

    public function setWeightEmptyAttribute(int $weight = 0)
    {
        $this->attributes['berat_kosong'] = $weight;
    }

    public function getTypeAttribute()
    {
        return $this->attributes['jenis'];
    }

    public function setTypeAttribute(string $type = 'unknown')
    {
        $this->attributes['jenis'] = $type;
    }

    // Relations
    public function vendor()
    {
        return $this->belongsTo(TruckVendor::class, 'id_vendor');
    }

    public function driver()
    {
        return $this->belongsTo(Supir::class, 'id_driver');
    }
}
