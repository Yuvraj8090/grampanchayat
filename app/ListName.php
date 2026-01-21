<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ListName extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'name', 'position', 'block', 'phone', 'image',
    ];
    
    public function user(){
        return $this->BelongsTo('App\User');
    }
    
    public function positions(){
        return $this->HasOne('App\Positions','name','position');
    }
}
