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
		return static::whereHas('posts', function ($query) {
			$query->where('public', 1);
		})
		->orderBy('count', 'desc')
		->limit(10)
		->pluck('name');
	}
}
