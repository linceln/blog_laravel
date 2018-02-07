<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class,  function (Faker $faker) {
	return [
		'title' => $faker->catchPhrase(),
		'body' => $faker->realText($maxNbChars = 200, $indexSize = 2),
		// 'body' => $faker->paragraph,
		'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
	];
});