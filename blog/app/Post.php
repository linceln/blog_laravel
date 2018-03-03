<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
	
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}


	public function user()
	{
		return $this->belongsTo(User::class);
	}


	public function tags()
	{
		return $this->belongsToMany(Tag::class);
	}


	public function addComment($content)
	{
		$this->comments()->create($content);
	}

	
	public function scopeFilter($query, $filters)
	{
		if(isset($filters['month']) && $month = $filters['month']){
			$query->whereMonth('created_at', Carbon::parse($month)->month);
		}

		if(isset($filters['year']) && $year = $filters['year']){
			$query->whereYear('created_at', $year);
		}

		if(isset($filters['tag']) && $tag = $filters['tag']){
			$query->whereHas('tags', function($query) use($tag){
				$query->where('name', $tag);
			});
		}
	}

	public function scopeIsPublic($query)
	{
		$query->where('public', 1);
	}


	public function attachToTag($tag_name)
	{
		$tag = Tag::updateOrCreate(['name' => $tag_name,]);
		if(!$tag->wasRecentlyCreated){
			$tag->increment('count');
		}
		$this->tags()->attach($tag);
	}

	public static function getAppendParamString($params)
	{
		$param = '';

		if(isset($params['tag'])){
			$param .= '&tag=' . $params['tag'];
		}
		if(isset($params['year'])){
			$param .= '&year=' . $params['year'];
		}
		if(isset($params['month'])){
			$param .= '&month=' . $params['month'];
		}

		return $param;
	}


	public static function archives()
	{
		return $archives = static::selectRaw('year(created_at) year,monthname(created_at) month,count(*) published')
		->groupBy('year', 'month')
		->orderByRaw('min(created_at) desc')
		->isPublic()
		->get();
	}

	public static function archivesCached()
	{
		return Cache::remember('posts.archives', 14400, function () { // 10 days
			return static::archives();
		});
	}
}
