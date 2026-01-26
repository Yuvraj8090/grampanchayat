<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Panchayat extends Model
{
    protected $fillable = ['block_id', 'name', 'panchayat_id', 'status', 'vpo_name', 'address'];

    /**
     * Relationship to Block
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class);
    }

    /**
     * Optimization: Get District directly from Panchayat via Block
     */
    public function district()
    {
        return $this->block->district();
    }
}