<?php

namespace App\Models;

use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $fillable = ['user_id', 'cart_data'];

    protected $table = 'cart';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
