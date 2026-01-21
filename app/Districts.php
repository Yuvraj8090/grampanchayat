<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use SoftDeletes;
    
    protected $table = "districts";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'state_id', 'name', 'status'
    ];
}