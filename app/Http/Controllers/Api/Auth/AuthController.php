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
use App\Models\User;
use App\Services\OtpService;

class AuthController extends Controller
{
    use ResponseTrait;
    public function __construct(protected UserService $userService, protected OtpService $otp_service) {}


    public function register(RegisterRequest $request): JsonResponse
    {
        $request->validated();
        $data = $request->all();
        $data['type'] = false;
        $user = $this->userService->create($data);
        $result = $this->otp_service->generateAndSendOtpEmail($user, 'email_verification');
        if ($result['success']) {
            return $this->success201([
                'user_id' => $user->id,
                'email' => $user->email,
            ], 'Registration successful. Please check your email for verification code.');
        } else {

            return $this->success201([
                'user_id' => $user->id,
                'email' => $user->email,
                'otp_failed' => true
            ], 'Registration successful but failed to send OTP. Use resend-otp endpoint.');
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = auth('api')->user();
        if (!$user->isEmailVerified()) {
            auth('api')->logout();
            return $this->error401('Please verify your email before logging in.');
        }

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

    public function resendVerifyEmail(Request $request): JsonResponse
    {
        $validated = $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $validated['email'])->first();
        if ($user->isEmailVerified()) {
            return $this->error400('Email already verified');
        }

        $result = $this->otp_service->generateAndSendOtpEmail($user, 'email_verification');

        if ($result['success']) {
            return $this->success200([
                'email' => $user->email,
            ], 'Verification code sent to your email.');
        } else {
            return $this->error500('Failed to send verification code. Please try again later.');
        }
    }

    public function verifyEmail(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:6'
        ]);
        $user = User::where('email', $validated['email'])->first();

        if ($user->isEmailverified()) {
            return $this->error400('Email already verified');
        }

        $result = $this->otp_service->verifyOtp($validated['email'], $validated['otp'], 'email_verification');

        if ($result['success']) {
            $result['user']->markEmailAsVerified();
            $token = JWTAuth::fromUser($result['user']);
            $expiration_time = now()->addMinutes(JWTAuth::factory()->getTTL())->timestamp;

            return $this->success200([
                'token' => $token,
                'expiration_time' => $expiration_time,
                'user' => $result['user']
            ], 'Email verified successfully.You can now login.');
        } else {
            return $this->error400($result['message']);
        }
    }
}
