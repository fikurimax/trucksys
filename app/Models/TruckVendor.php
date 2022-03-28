<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $contact
 * @property integer $tin // tax identification number
 */
class TruckVendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'alamat', 'kontak', 'npwp'
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
    protected $appends = ['name', 'address', 'contact', 'tin'];

    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    public function getNameAttribute()
    {
        return $this->attributes['nama'];
    }

    public function setNameAttribute(string $name)
    {
        $this->attributes['nama'] = $name;
    }

    public function getAddressAttribute()
    {
        return $this->attributes['alamat'];
    }

    public function setAddressAttribute(string $address = '')
    {
        $this->attributes['alamat'] = $address;
    }

    public function getContactAttribute()
    {
        return $this->attributes['kontak'];
    }

    public function setContactAttribute(string $contact = '')
    {
        $this->attributes['kontak'] = $contact;
    }

    public function getTinAttribute()
    {
        return $this->attributes['npwp'];
    }

    public function setTinAttribute(string $tin = '')
    {
        $this->attributes['npwp'] = $tin;
    }

    // Relations
    public function trucks()
    {
        return $this->hasMany(Truck::class, 'id_vendor');
    }
}
