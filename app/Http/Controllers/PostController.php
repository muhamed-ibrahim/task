<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function __construct(protected PostService $postService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = $this->postService->all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $this->postService->create($request->validated());
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): RedirectResponse|View
    {
        $post = $this->postService->find($id);
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): RedirectResponse|View
    {

        $post = $this->postService->find($id);
        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }
        if ($post->user_id !== auth()->user()->id){
            return abort(403, 'you dont have permission.');

        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id): RedirectResponse
    {
        $post = $this->postService->find($id);
        $this->postService->update($request->validated(), $post);
        return redirect()->route('posts.me')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $post = $this->postService->find($id);
        if ($post->user_id !== auth()->user()->id){
            return abort(403, 'you dont have permission.');

        }
        $this->postService->delete($post);
        return redirect()->route('posts.me')->with('success', 'Post deleted successfully.');
    }

    public function myPosts(): View
    {
        $posts = $this->postService->myPosts();
        return view('posts.my-posts',compact('posts'));
    }
}
