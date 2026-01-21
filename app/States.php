<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use SoftDeletes;
    
    protected $table = "states";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'status'
    ];
}