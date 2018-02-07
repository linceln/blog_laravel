<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Comment;
use App\Tag;
use App\PostTag;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		User::create([
			'name' => 'lincoln',
			'email' => 'lincoln@example.com',
			'password' => '$2y$10$/39SXwZIYclDmgc/8njv5e7vSMoiA5HW.BCWRFifI3bS64h.54MTi', // lincoln
			'remember_token' => str_random(10)
		]);

		factory(User::class, 20)->create()->each(function ($user) {
			// Create posts
			factory(Post::class, rand(1, 3))->create(['user_id' => $user->id])->each(function ($post) use ($user) {
				// Attach each post to user
				$user->posts()->save($post);
				// Add Comments
				factory(Comment::class, rand(10, 100))->create([
					'user_id' => $user->id,
					'post_id' => $post->id
				]);
				// Create tags
				$tags = factory(Tag::class, rand(1, 3))->create();
				// Attach tags to post
				$post->tags()->saveMany($tags);
			});
		});
	}
}