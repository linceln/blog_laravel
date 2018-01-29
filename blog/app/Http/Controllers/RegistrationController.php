<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class RegistrationController extends Controller
{

	public function create()
	{

		return view('registration.create');

	}

    
	public function store()
	{

		// Validate input 

		$this->validate(request(), [

			'name' => 'required|min:6',

			'email' => 'required|email',

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


		// Redirect to home page

		return redirect('/');

	}
}
