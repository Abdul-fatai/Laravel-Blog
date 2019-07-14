<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    //Primary Key
    public $primarykey = "id";


    //TimeStamp 
    public $timestamp = true;


    public function posts(){
        return $this->belongsTo('App\Post');
    }

}
