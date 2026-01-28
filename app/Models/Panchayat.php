<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Panchayat extends Model
{
    protected $fillable = ['block_id', 'name', 'panchayat_id', 'status', 'vpo_name', 'address'];

    /**
     * Relationship: A Panchayat belongs to a Block.
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }
    public function places(): HasMany
    {
        return $this->hasMany(PanchayatPlace::class);
    }
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
    public function businesses(): HasMany
    {
        return $this->hasMany(PanchayatBusiness::class);
    }
}
