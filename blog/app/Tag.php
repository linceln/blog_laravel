<?php

namespace App;

use App\Post;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
	public function posts()
	{
		return $this->belongsToMany(Post::class);
	}

	public function store($name)
	{
		
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

	public static function tagsCached()
	{
		return Cache::remember('popular_tags', 60, function () { // 1 hour
			return static::tags();
		});
	}


}
