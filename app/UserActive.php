<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActive extends Model
{
    protected $table = 'user_actives';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
