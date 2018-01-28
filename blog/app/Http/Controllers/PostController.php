<?php

namespace App\Http\Controllers;

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

		$posts = Post::with('comments')->latest()->get();

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

		$this->validate(request(), [

			'title' => 'required',

			'body' => 'required'

		]);

		Post::create(request(['title', 'body']));

		return redirect('/');

	}


}
