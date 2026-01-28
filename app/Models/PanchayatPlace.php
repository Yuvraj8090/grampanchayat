<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PanchayatPlace extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'panchayat_id',
        'title',
        'description',
        'photo',
        'address',
        'status',
    ];

    /**
     * Get the panchayat that owns the place.
     */
    public function panchayat(): BelongsTo
    {
        return $this->belongsTo(Panchayat::class);
    }
}