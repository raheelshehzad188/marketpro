<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserResult extends Model
{


    protected $fillable = [
        'users_id', 'results_id', 'type1_plants', 'type2_plants', 'type3_plants', 'type1', 'type2', 'type3','email'
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function results()
    {
        return $this->belongsTo(Result::class, 'results_id');
    }
}
