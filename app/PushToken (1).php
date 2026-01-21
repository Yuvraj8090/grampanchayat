<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PushToken extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = "push_token";
    
    protected $fillable = [
        'user_id',
        'token',
        'name',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
