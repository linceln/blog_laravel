<?php

namespace App;

use App\Post;

class Tag extends Model
{
    public function posts()
    {
    	return $this->belongsToMany(Post::class);
    }

    public static function tags()
    {
    	return static::has('posts')->orderBy('count', 'desc')->limit(10)->pluck('name');
    }
}
