<?php

// User and Auth

Route::get('/register', 'RegistrationController@create')->name('register');

Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create')->name('login');

Route::post('/login', 'SessionController@store');

Route::get('/logout', 'SessionController@destroy'); // TODO: Should be POST.


// Post and Comment

Route::get('/', 'PostController@index')->name('index');

Route::get('/posts', 'PostController@index');

Route::get('/posts/create', 'PostController@create');

Route::post('/posts', 'PostController@store');

Route::get('/posts/{post}', 'PostController@show');

Route::post('/posts/{post}/comments', 'CommentController@store');

// Tags



