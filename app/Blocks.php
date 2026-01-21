<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blocks extends Model
{
    use SoftDeletes;
    
    protected $table = "blocks";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'district_id', 'name', 'status'
    ];
}