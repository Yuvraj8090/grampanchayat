<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends Model
{
    protected $fillable = ['state_id', 'name', 'district_code', 'is_active'];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }

    public function panchayats(): HasManyThrough
    {
        return $this->hasManyThrough(Panchayat::class, Block::class);
    }
}