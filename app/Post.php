<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //TableName
    protected $table = "posts";

    //Primary Key
    Public $primaryKey = "id";

    //Timestamps
    public $timestamp = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tag(){
        return $this->hasMany(Tag::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
