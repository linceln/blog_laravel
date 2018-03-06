<?php

namespace App\Http\Controllers\Api;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Post;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function test()
    {
    	// $validator = Validator::make(request()->all(), [
    	// 	'param' => 'required'
    	// ]);

    	// if($validator->fails()){
    	// 	throw new ApiException($validator->errors());
    	// }

    	$this->validate(request(), [
    		'param' => 'required'
    	], [
    		'param.required' => 'param 是必填项'
    	]);

    	return [
    		'code' => 1,
    		'message' => 'test',
    		'data' => Post::find(1)
    	];
    }
}
