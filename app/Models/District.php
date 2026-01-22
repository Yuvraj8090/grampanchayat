<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends Model
{
    protected $fillable = ['name', 'district_code', 'is_active'];

    /**
     * Get all blocks for the district.
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class)->orderBy('name');
    }

    /**
     * Get all panchayats in the district through blocks.
     * Use this for high-speed reporting at state level.
     */
    public function panchayats(): HasManyThrough
    {
        return $this->hasManyThrough(Panchayat::class, Block::class);
    }

    /**
     * Scope for active districts only (Speed optimization for dropdowns)
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}