<?php

Route::get('/test', 'TestController@test');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');
Route::get('/me', 'AuthController@me');
Route::get('/refresh', 'AuthController@refresh');

Route::get('/posts', 'PostController@index');
Route::get('/posts/{post}', 'PostController@show');
Route::post('/posts', 'PostController@store');
