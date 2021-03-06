<?php
namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Post;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('index', 'show');
	}


	public function index()
	{
		// Visits
		Redis::incr('visits');
		
		$params = request(['month', 'year', 'tag']);
		$param = Post::getAppendParamString($params);

		$posts = Post::with('user:id,name', 'tags:id,name')
		->isPublic()
		->latest()
		->filter($params)
		->paginate(10);

		return view('posts.index', compact('posts', 'param'));
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
		$this->authorize('create', Post::class);

		return view('posts.create');
	}


	public function store()
	{
		// Authorize
		$this->authorize('create', Post::class);

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