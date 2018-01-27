<?php

namespace App;


class Post extends Model
{

	public function comments()
	{

		return $this->hasMany(Comment::class);

	}


	public function addComment($content)
	{

		$this->comments()->create(['content' => $content]);

	}

}
