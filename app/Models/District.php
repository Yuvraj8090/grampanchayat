<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends Model
{
    // Added 'state_id' to fillable
    protected $fillable = ['state_id', 'name', 'district_code', 'is_active'];

    /**
     * Relationship to State
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get all blocks for the district.
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)->orderBy('name');
    }

    /**
     * Get all panchayats in the district through blocks.
     */
    public function panchayats(): HasManyThrough
    {
        return $this->hasManyThrough(Panchayat::class, Block::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}