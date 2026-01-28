<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PanchayatMember extends Model
{
   use HasFactory;

    protected $fillable = [
        'panchayat_id',
        'name',
        'designation',
        'ward_no',
        'phone',
        'image',
        'order_by',
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
