<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\OTPRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Mail\LockNotification;
use App\Mail\OTPNotification;
use App\Models\CodeVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Psy\Util\Str;

class AuthController extends Controller
{
    public function index()
    {
        return (user()) ? redirect()->route('dashboard') : $this->login();
    }

    public function login()
    {
        logout_all_guards();

        return view('login');
    }

    public function processLogin(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $validatedData['email'])->first();

            // Account lock attempt
            if ($user && $user->login_attempts >= config('auth.max_attempts')) {
                $lockDuration = config('auth.lock_duration');
                $user->update(['login_attempts' => 0, 'lock_until' => now()->addMinutes($lockDuration)]);

                // Optional: Send notification to user
                $this->sendLockNotification($user);
            }

            // Check if email is verified
            if (!$user->email_verified_at) {
                return redirect()->route('login')->withErrors(['Notice!' => 'Please verify your email address first.']);
            } elseif ($user->status != 'active') {
                return redirect()->route('login')->withErrors(['Notice!' => 'Account inactive, contact administrator']);
            }

            // Generate and send OTP
            $otp = rand(100000, 999999);
            $loginToken = Str::random(70) . '-' . transaction_uniq();

            CodeVerification::updateOrCreate(
                ['user_id' => $user->uuid],
                [
                    'otp' => $otp,
                    'intent' => 'otp',
                    'login_token' => $loginToken,
                    'expires_at' => Carbon::now()->addMinutes(config('system.otp_validity'))
                ],
            );

            $user->update([
                'login_token' => $loginToken,
            ]);

            logout_all_guards();
            $this->sendOTPNotification($otp, $user);

            return view('otp', compact('loginToken', 'otp', 'user'));
        }

        return redirect()->route('login')->withErrors(['Failed!' => 'Invalid email or password']);
    }

    public function verifyOTP(OTPRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where(['login_token' => $validatedData['login_token']])->first();
        $verify = CodeVerification::where('login_token', $validatedData['login_token'])->first();

        if (!$user || !$verify->isOtpValid($validatedData['otp'])) {
            return back()->withErrors(['Failed!' => 'Invalid or expired OTP code.']);
        }

        Auth::login($user);
        $user->update(['otp' => null, 'intent' => null, 'login_token' => null, 'expires_at' => null]);

        return redirect()->intended(route('dashboard'))->with('success', 'Logged in successfully!');
    }

    public function logout()
    {
        Auth::logout();
        Session::flash();

        return redirect()->route('login');
    }

    private function sendLockNotification($user)
    {
        Mail::to($user->email)->send(new LockNotification($user));
    }

    private function sendOTPNotification($otp, $user)
    {
        Mail::to($user->email)->send(new OTPNotification($otp, $user));
    }

}
