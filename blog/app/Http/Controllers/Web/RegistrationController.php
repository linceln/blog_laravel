<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\User;

class RegistrationController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function create()
	{
		return view('registration.create');
	}

    
	public function store()
	{
		// Validate input 
		$this->validate(request(), [
			'name' => 'required|min:6',
			'email' => 'bail|required|email|unique:users',
			'password' => 'required|min:6|confirmed'
		]);

		// Create and save user
		$user = User::create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => bcrypt(request('password'))
		]);
		
		// Login user
		auth()->login($user);

		// Flash message
		session()->flash('msg', 'Thank you for signing up!');

		// Redirect to home page
		return redirect('/');
	}
}
