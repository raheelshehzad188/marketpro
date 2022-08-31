<?php

namespace App;

use App\User;
use App\Address;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'address_id', 'price', 'tax', 'shipping_cost', 'discount', 'product_referral_code', 'coupon_code', 'coupon_applied', 'quantity', 'user_id', 'temp_user_id', 'owner_id', 'product_id', 'variation', 'heared_about_us', 'email', 'address', 'phone', 'about_project', 'include',
        'addons', 'garden1', 'garden2', 'garden3', 'cart_type', 'garden1_plants', 'garden2_plants', 'garden3_plants','cart_step'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
