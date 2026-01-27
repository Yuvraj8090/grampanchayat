<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanchayatDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship back to the core Panchayat table
    public function panchayat()
    {
        return $this->belongsTo(Panchayat::class);
    }
}