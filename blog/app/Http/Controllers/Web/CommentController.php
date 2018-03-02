<?php

namespace App\Http\Controllers\Web;

use App\Post;
use App\Comment;

class CommentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


	public function store(Post $post)
	{
		$this->authorize('create', Comment::class);

		$this->validate(request(), [
			'comment' => 'required'
		]);

		$post->addComment([
			'content' => request('comment'),
			'user_id' => auth()->id()
		]);

		return back();
	}
}
