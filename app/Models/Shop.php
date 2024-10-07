<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'entity', 'visibility_pivot', 'shop_id', 'entity_id');
    }
}
