<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $identity_number
 * @property integer $driver_license_number
 * @property string $contact
 */
class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'alamat', 'no_ktp', 'no_sim', 'handphone'
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
        'name', 'address', 'identity_number', 'driver_license_number', 'contact'
    ];

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

    public function setAddressAttribute(string $address)
    {
        $this->attributes['alamat'] = $address;
    }

    public function getContactAttribute()
    {
        return $this->attributes['handphone'];
    }

    public function setContactAttribute(string $contact)
    {
        $this->attributes['handphone'] = $contact;
    }

    public function getIdentityNumberAttribute()
    {
        return $this->attributes['no_ktp'];
    }

    public function setIdentityNumberAttribute(string $identity_number)
    {
        $this->attributes['no_ktp'] = $identity_number;
    }

    public function getDriverLicenseNumberAttribute()
    {
        return $this->attributes['no_sim'];
    }

    public function setDriverLicenseNumberAttribute(string $driver_license_attribute)
    {
        $this->attributes['no_sim'] = $driver_license_attribute;
    }

    // Relations
    public function truck()
    {
        return $this->hasOne(Truck::class, 'id_driver');
    }
}
