<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Table Name
    protected $table = "tag";

    //Primary Key
    public $primaryKey = 'id';
    

    //Timestamp
    public $timestamp = true;

    public function posts(){
        return $this->belongsTo(Post::class);
    }
    
    
}
