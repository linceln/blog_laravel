<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('register', 'login');
    }

    public function register(Request $request)
    {
        // Validate input
        $this->validate(request(), [
            'name' => 'required|min:6',
            'email' => 'bail|required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        // Create and save user
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return response()->json(['message' => '注册成功']);
    }

    public function login()
    {
        $this->validate(request(), [
            'email' => 'bail|required|email',
            'password' => 'required|min:6'
        ]);

        if ($token = auth()->guard('api')->attempt(request(['email', 'password']))) {
            return $this->responseWithToken($token);
        } else {
            return response()->json(['error' => '账户名或密码错误'], 401);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    private function responseWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }
}
