<?php

namespace App\Http\Controllers\Api;

use App\Post;

class TestController extends Controller
{
    public function test()
    {
        $this->validate(request(), [
            'param' => 'required',
            'username' => 'required|string'
        ], [
            'param.required' => 'param 是必填项',
            'username.required' => 'username 是必填项',
            'username.string' => 'username 必须是字符串'
        ]);

        return [
            'code' => 1,
            'message' => 'test',
            'data' => Post::find(1)
        ];
    }
}
