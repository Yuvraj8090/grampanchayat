<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class GovtFacility extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'title', 'image','description',
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    
    public function getImageAttribute($value){
        return asset('govt/'.$value);
        
    }
}
