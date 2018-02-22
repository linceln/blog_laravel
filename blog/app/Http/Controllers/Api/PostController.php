<?php
namespace App\Http\Controllers\Api;

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
		$params = request(['month', 'year', 'tag']);
		$param = Post::getAppendParamString($params);

		// Visits
		dd($params);
		if(empty($params)){
			Redis::incr('visits');
		}
		
		$posts = Post::with('user:id,name', 'tags:id,name')
		->isPublic()
		->latest()
		->filter($params)
		->paginate(10);

		return $posts;
	}


	public function show($id)
	{
		$post = Post::with([
			'user:id,name',
			'comments' => function($query){
				$query->with('user:id,name')->latest();
			}])
		->find($id);

		return $post;
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
		}, 5);

		return [
			'code' => 1,
			'msg' => 'Success'
		];
	}
}