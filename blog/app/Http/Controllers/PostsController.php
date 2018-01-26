<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class PostsController extends Controller
{
    public function index(){
    	$posts = Posts::all();
    	return $posts;
    }

    public function store(Posts $post){

    }
}
