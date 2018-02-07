<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->word,
		'count' => rand(1, 100)
	];
});

// $factory->define(App\PostTag::class, function (Faker $faker) {
// 	return [
// 		'post_id' => function () {
// 			return factory(App\Post::class)->create()->id;
// 		},
// 		'tag_id' => function () {
// 			return factory(App\Tag::class)->create()->id;
// 		}
// 	];
// });