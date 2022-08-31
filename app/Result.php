<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Result extends Model
{

    public function ttype1() {
        return $this->belongsTo(Garden::class,'type1');
    }

    public function ttype2() {
        return $this->belongsTo(Garden::class,'type2');
    }

    public function ttype3() {
        return $this->belongsTo(Garden::class,'type3');
    }

}
