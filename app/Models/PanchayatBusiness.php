<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PanchayatBusiness extends Model
{
    use HasFactory;

    protected $fillable = [
        'panchayat_id',
        'title',
        'description',
        'image',
        'status',
    ];

    /**
     * Get the full URL for the business image.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Relationship: Business belongs to a Panchayat.
     */
    public function panchayat(): BelongsTo
    {
        return $this->belongsTo(Panchayat::class);
    }
}