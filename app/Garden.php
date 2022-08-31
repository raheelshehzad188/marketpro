<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Garden extends Model
{

    public function plants(){
        return $this->belongsToMany('App\Plant');
    }

}
