<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'topic', 'content'
    ];

    public function category(){
        return $this->belongsTo('App\category');
    }
    public function user(){
        return $this->belongsTo("App\User");
    }
    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function Rating(){
        return $this->hasMany("App\Rating");
    }

    public function bookmark(){
        return $this->hasMany('App\Bookmark');
    }
}
