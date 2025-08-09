<?php

namespace App\Http\Controllers\Api;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ApiUpdateUserRequest;

class UserController extends Controller
{
    use ResponseTrait;
    public function __construct(protected UserService $userService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->all();
        return $this->success200($users, 'Users retrivied successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $request->validated();
        $user =  $this->userService->create($request->all());
        return $this->success201($user, 'Users retrivied successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->userService->find($id);
        if (!$user) {
            return $this->error404('User not found.');
        }
        return $this->success200($user, 'Users retrivied successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ApiUpdateUserRequest $request, int $id): JsonResponse
    {
        $request->validated();
        $updateduser = $this->userService->update($request->all(), $id);
        return $this->success200($updateduser, 'User updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return $this->success200([], 'User deleted successfully.');
    }
}
