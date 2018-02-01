<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Database\QueryException;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('index', 'show');
	}
	
	
	public function index()
	{
		Redis::incr('visits');

		$posts = Post::with('user:id,name', 'tags:id,name')
		->latest()
		->filter(request(['month', 'year', 'tag']))
		->get();

		return view('posts.index', compact('posts'));
	}


	public function show($id)
	{
		$post = Post::with([
			'user:id,name',
			'comments' => function($query){
				$query->with('user:id,name')->latest();
			}])
		->find($id);

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
		
		DB::transaction(function () {
			// Create a post
			$post = auth()->user()->publish(new Post(request(['title', 'body'])));

			// Attach tags to the post
			foreach (array_filter(explode(',', request('tags')), 'strlen') as $tag_name) {
				$post->attachToTag($tag_name);
			}
			
			// Flash message
			session()->flash('msg', "Your post has now been published!");
		}, 5);

		return redirect('/');
	}
}