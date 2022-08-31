<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    // public function posts()
    // {
    //     return $this->hasMany(Blog::class,'category_id');
    // }

    public function posts()
    {
        return $this->belongsToMany(Blog::class, 'blog_category_pivot');
    }
}
