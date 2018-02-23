<?php

namespace App\Http\Controllers\Web;

class SessionController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest')->except('destroy');
	}


	public function create()
	{
		return view('session.create');
	}


	public function store()
	{
		$this->validate(request(), [
			'email' => 'required|min:6',
			'password' => 'required|min:6'
		]);


		if(!auth()->attempt(request(['email', 'password']))){
			return back()->withErrors([
				'message' => "帐号或密码错误"
			]);
		}

		// Flash message
		session()->flash('msg', 'Thank you for signing in!');

		return redirect()->intended(route('login'));
	}


	public function destroy()
	{
		// Logout
		auth()->logout();

		// Flash message
		session()->flash('msg', 'You have successfully logout!');

		return redirect('/');
	}
}
