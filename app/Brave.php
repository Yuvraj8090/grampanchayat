<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Brave extends Model
{
    use SoftDeletes;
    
    protected $table = "brave";
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id','image', 'name', 'award','reason','about'
    ];
    
    public function user(){
        return $this->BelongsTo('App\User');
    }
    
    public function getImageAttribute($value){
        return asset('brave/'.$value);
    }
}