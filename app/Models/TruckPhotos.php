<?php

namespace App\Models;

use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($photo) {
            Log::debug($photo->description . " - " . $photo->filename);
            Storage::delete('public' . DIRECTORY_SEPARATOR . 'trucks' . DIRECTORY_SEPARATOR . $photo->filename);
        });
    }
}
