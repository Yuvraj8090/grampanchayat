<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ImporantTitle extends Model
{
    use SoftDeletes;
    
    protected $table = "important_titles";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title','status','link_title','link'
    ];
    
    public function posts(){
        return $this->HasMany(ImportantPosts::class,'ref_id','id');
    }
}