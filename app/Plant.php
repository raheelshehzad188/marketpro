<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Plant extends Model
{

    public function gardens(){
        return $this->belongsToMany('App\Garden');
    }


}
