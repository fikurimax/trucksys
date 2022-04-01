<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_truck
 * @property string $description
 * @property string $filename
 */
class TruckPhotos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_truck',
        'description',
        'filename'
    ];

    // Relations
    public function truck()
    {
        return $this->belongsTo(Truck::class, 'id_truck');
    }
}
