<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostService
{
    public function all(): mixed
    {
        return Post::orderBy('created_at', 'desc')->paginate(5);
    }

    public function myPosts(): mixed
    {
        return  Post::where('user_id',auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
    }

    public function find(int $id): ?Post
    {
        return Post::find($id);
    }

    public function create(array $data): Post
    {
        $data['user_id'] = auth()->user()->id;
        return Post::create($data);
    }

    public function update(array $data, Post $post): Post
    {
        $post->update($data);
        return $post;
    }

    public function delete(post $post): bool
    {
        return $post->delete();
    }

    public function countPosts():int
    {
        return Post::count();
    }


}
