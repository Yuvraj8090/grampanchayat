<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'is_active', 'role_id', 'slug', 'hindi', 'google','state_id',
        'district_id','block_id','api_token','status','occupation','qualification','stream','dob','pic','d_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function isAdmin()
    {
        if ($this->role->name == "Admin") 
        {
            return true;
        }

        return false;
    }

    public function isUser()
    {
        if ($this->role->name == "User") 
        {
            return true;
        }

        return false;
    }

    public function intro()
    {
        return $this->hasMany('App\Intro');
    }
    
    public function getPicAttribute($value){
        
        if($value){
            return asset('profile/'.$value);
        }
        return NULL;
    }
    
    public function state(){
        return $this->hasOne('App\States','id','state_id');
    }
    
    public function district(){
        return $this->hasOne('App\Districts','id','district_id');
    }
    
    public function block(){
        return $this->hasOne('App\Blocks','id','block_id');
    }
    
     
    public function listname(){
        return $this->HasMany('App\ListName');
    }
    
    public function govtfacility(){
        return $this->HasMany('App\GovtFacility');
    }

}
