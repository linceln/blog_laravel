<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
    }

    public function view(User $user, Post $post)
    {
        // Blog is public or user is yourself then we don't care whether post is public
        return $post->public || $user->id === $post->user_id;
    }

    public function create(User $user)
    {
        return $user->active;
    }

    public function update(User $user, Post $post)
    {
        return $user->active && $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->active && $user->id === $post->user_id;
    }
}
