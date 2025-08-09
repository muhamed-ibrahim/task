<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = $this->userService->all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $request->validated();
        $this->userService->create($request->all());
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): RedirectResponse|View
    {
        $user = $this->userService->find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): RedirectResponse|View
    {
        $user = $this->userService->find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $request->validated();
        $this->userService->update($request->all(), $id);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->userService->delete($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
