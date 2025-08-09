<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    use ResponseTrait;
    public function __construct(protected UserService $userService) {}


    public function register(RegisterRequest $request): JsonResponse
    {
        $request->validated();
        $data = $request->all();
        $data['type'] = false;
        $user = $this->userService->create($data);
        $token = JWTAuth::fromUser($user);
        $expiration_time = now()->addMinutes(JWTAuth::factory()->getTTL())->timestamp;
        return $this->success201([
            'token' => $token,
            'expiration_time' => $expiration_time,
            'user' => $user
        ], 'User created successfully.');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = auth('api')->user();
        $expiration_time = now()->addMinutes(JWTAuth::factory()->getTTL())->timestamp;
        return $this->success200([
            'token' => $token,
            'expiration_time' => $expiration_time,
            'user' => $user
        ], 'User logged in successfully');
    }

    public function logout(): JsonResponse
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::parseToken()->authenticate();
        JWTAuth::invalidate($token);
        return $this->success200([], 'User successfully logged out.');
    }
}
