<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    // REMOVED the faulty district() method.
    // We will access it as: $panchayat->block->district
}