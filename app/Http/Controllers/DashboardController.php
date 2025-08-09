<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __construct(protected PostService $postService, protected UserService $userService) {}
    public function index(): RedirectResponse|View
    {
        $postsCount = $this->postService->countPosts();
        $usersCount = $this->userService->countUsers();

        return view('dashboard', compact('postsCount', 'usersCount'));
    }
}
