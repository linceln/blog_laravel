<?php

use Illuminate\Database\Seeder;
use App\User;
use App\PostTag;

class DatabaseSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
	User::create([
		'name' => 'lincoln',
		'email' => 'lincoln@example.com',
		'password' => '$2y$10$/39SXwZIYclDmgc/8njv5e7vSMoiA5HW.BCWRFifI3bS64h.54MTi', // lincoln
		'remember_token' => str_random(10)
	]);
	factory(PostTag::class, 10)->create();
}
}
