<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class State extends Model
{
    protected $fillable = ['name', 'state_code', 'is_active'];

    /**
     * Get all districts for the state.
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class)->orderBy('name');
    }

    /**
     * Get all blocks in the state through districts.
     * Useful for State-level reporting.
     */
    public function blocks(): HasManyThrough
    {
        return $this->hasManyThrough(Block::class, District::class);
    }

    /**
     * Scope for active states only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}