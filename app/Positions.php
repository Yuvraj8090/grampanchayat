<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'status', 's_no',
    ];
    
    public function listname(){
        return $this->belongsTo('App\ListName','position','name');
    }
}
