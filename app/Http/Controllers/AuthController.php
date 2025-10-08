<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Services\OtpService;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    use ResponseTrait;
    public function __construct(protected UserService $userService, protected OtpService $otp_service) {}

    public function viewRegister(): RedirectResponse|View
    {
        return view('auth.register');
    }

    public function viewLogin(): RedirectResponse|View
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $request->validated();
        $data = $request->all();
        $data['type'] = false;
        $user = $this->userService->create($data);

        $result = $this->otp_service->generateAndSendOtpEmail($user, 'email_verification');
        if ($result['success']) {
            return redirect()->route('email.verify')
                ->with('email', $user->email)
                ->with('success', 'Account created! Please check your email for verification code.');
        } else {
            return redirect()->route('email.verify')
                ->with('email', $user->email)
                ->with('error', 'Account created but failed to send verification email. You can request a new code.');
        }
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->validated();
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->isEmailVerified()) {
                $result =  $this->otp_service->generateAndSendOtpEmail($user, 'email_verification');
                Auth::logout();
                if ($result['success']) {
                    return redirect()->route('email.verify')
                        ->with('email', $user->email)
                        ->with('success', 'Please verify your email address. We\'ve sent you a verification code.');
                } else {
                    return back()->with('error', 'Failed to send verification email. Please try again.');
                }
            }
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->with('error', 'The provided credentials do not match our records.',);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function ViewEmailVerification(): RedirectResponse|View
    {
        $email = session('email');

        if (!$email) {
            return redirect()->route('login')
                ->with('error', 'Please login to verify your email address.');
        }
        return view('auth.verify-email', compact('email'));
    }

    public function verifyEmailOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|numeric|digits:6'
        ]);


        $result = $this->otp_service->verifyOtp($request['email'], $request['otp_code'], 'email_verification');
        if ($result['success']) {
            $result['user']->markEmailAsVerified();
            Auth::login($result['user']);
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Email verified successfully! Welcome to your dashboard.');
        } else {
            return redirect()->back()
                ->with('email', $request['email'])
                ->with('error', $result['message']);
        }
    }

    public function resendEmailVerification(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $request['email'])->first();

        if ($user->isEmailVerified()) {
            return redirect()->route('dashboard')->with('success', 'Email is already verified.');
        }

        $result = $this->otp_service->generateAndSendOtpEmail($user, 'email_verification');

        if ($result['success']) {
            return back()
                ->with('email', $request['email'])
                ->with('success', 'New verification code sent to your email.');
        }

        return back()
            ->with('email', $request['email'])
            ->with('error', $result['message']);
    }
}
