<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Block extends Model
{
    protected $fillable = ['district_id', 'name', 'block_code', 'is_active'];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function panchayats(): HasMany
    {
        return $this->hasMany(Panchayat::class);
    }
}