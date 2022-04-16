<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDocument extends Model
{
    use HasFactory;

    protected $table = 'vendor_documents';
    protected $fillable = [
        'id_vendor',
        'description',
        'filename',
    ];
}
