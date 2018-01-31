<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('index', 'show');
	}
	
	
	public function index()
	{
		Redis::incr('visits');

		$posts = Post::with('comments', 'user')
		->latest()
		->filter(request(['month', 'year', 'tag']))
		->get();

		return view('posts.index', compact('posts'));
	}


	public function show(Post $post)
	{
		return view('posts.detail', compact('post'));
	}


	public function create()
	{
		return view('posts.create');
	}


	public function store()
	{
		// Validate
		$this->validate(request(), [
			'title' => 'required',
			'body' => 'required'
		]);
		
		// Create a post
		$post = auth()->user()->publish(new Post(request(['title', 'body'])));

		// Attach tags to post
		foreach (array_filter(explode(',', request('tags')), 'strlen') as $tag_name) {
			$tag = Tag::updateOrCreate(['name' => $tag_name,]);
			if(!$tag->wasRecentlyCreated){
				$tag->increment('count');
			}
			$post->tags()->attach($tag);
		}

		return redirect('/');
	}
}