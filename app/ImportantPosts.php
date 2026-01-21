<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ImportantPosts extends Model
{
    use SoftDeletes;
    
    protected $table = "important_posts";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ref_id', 'content', 'status'
    ];
    
    
    public function title(){
        return $this->BelongsTo(ImporantTitle::class,'ref_id','id');
    }
}