<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'panchayat_id',
        'path',
        'caption',
        'type',
        'is_featured'
    ];

    /**
     * Get the panchayat that owns the gallery item.
     */
    public function panchayat(): BelongsTo
    {
        return $this->belongsTo(Panchayat::class);
    }
}