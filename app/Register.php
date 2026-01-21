<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'name', 'age', 'phone', 'email', 'pin', 'occupation', 'qualification', 'stream','block','district','state','dob'
    ];
}
