<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('index', 'show');
	}
	
	
	public function index()
	{
		$visits = Redis::incr('visits');

		$posts = Post::with('comments', 'user')
		->latest()
		->filter(request(['month', 'year']))
		->get();

		return view('posts.index', compact(['posts', 'visits']));
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
		auth()->user()->publish(new Post(request(['title', 'body'])));
		return redirect('/');
	}
}
