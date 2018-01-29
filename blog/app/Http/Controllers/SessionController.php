<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

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

			return back();

		}


		return redirect('/');

	}


	public function destroy()
	{

		auth()->logout();


		return redirect('/');

	}

}
