<?php
namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->except('index', 'show');
	}


	public function index()
	{
		Redis::incr('visits');

		$params = request(['month', 'year', 'tag']);

		$posts = Post::with('user', 'tags')
		->isPublic()
		->latest()
		->filter($params)
		->paginate(10);

		return PostResource::collection($posts);
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