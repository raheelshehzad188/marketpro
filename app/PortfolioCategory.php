<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioCategory extends Model
{
    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Portfolio::class);
    }
}
