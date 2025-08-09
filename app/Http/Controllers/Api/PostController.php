<?php

namespace App\Http\Controllers\Api;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\ApiUpdatePostRequest;


class PostController extends Controller
{
    use ResponseTrait;
    public function __construct(protected PostService $postService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->all();
        return $this->success200($posts, 'Post retrivied successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $post = $this->postService->create($request->validated());
        return $this->success201($post, 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $post = $this->postService->find($id);
        if (!$post) {
            return $this->error404('Post not found.');
        }
        return $this->success200($post, 'Post retrivied successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApiUpdatePostRequest $request, string $id): JsonResponse
    {
        $post = $this->postService->find($id);
        if ($post->user_id !== auth('api')->user()->id) {
            return $this->error403('you dont have permission.');
        }

        $updatepost =  $this->postService->update($request->validated(), $post);
        return $this->success201($updatepost, 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $post = $this->postService->find($id);
        if ($post->user_id !== auth('api')->user()->id) {
            return $this->error403('you dont have permission.');
        }
        $this->postService->delete($post);
        return $this->success200([], 'Post deleted successfully.');
    }

    public function myPosts(): JsonResponse
    {
        $posts = $this->postService->myPosts();
        if ($posts->isEmpty()) {
            return $this->error404('No posts found for the user.');
        }
        return $this->success200($posts, 'My Posts retrivied successfully.');
    }
}
