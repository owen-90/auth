<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\PasswordResetLink;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Psy\Util\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => bcrypt($validatedData['password']),
            'email_verified' => null,
        ]);

        // TODO :: Implement expiry logic
        $verificationCode = Str::random(32);
        $user->update(['email_verification_code' => $verificationCode]);

        Mail::to($user->email)->send(new VerificationEmail($user, $verificationCode));

        return redirect()->route('register')->with('Success', 'Registration successful');
    }

    public function verify(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['Error' => 'User not found!']);
        }

        if (!Hash::check($validatedData['code'], $user->email_verification_code)) {
            return redirect()->route('verification')->withErrors(['Failed' => 'Invalid code']);
        }

        $user->update(['email_verified_at' => now()]);

        return redirect()->route('login')->with('success', 'Email verified successfully');
    }

    public function resetPass()
    {
        return view('reset-pass');
    }

    public function resetLink(ForgotPasswordRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $token = Str::random(64);
        $expiresAt = now()->addHour();

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now(),
            'expires_at' => $expiresAt,
        ]);

        $url = route('reset-pass', $token);
        Mail::to($user->email)->send(new PasswordResetLink($user, $url));

        return back()->with('Success', 'Password reset link sent successfully!');
    }

    public function reset(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $status = Password::reset(
            $validatedData['email'],
            function ($user, $password) use ($validatedData) {
                $user->ForceFill([
                    'password' => Hash::make($validatedData['password']),
                    'remember_token' => Str::random(60),
                ])->save();
            },
            $validatedData['token']
        );

        if ($status === Password::PASSWORD_RESET) {
            DB::table('password_resets')->where('token', $validatedData['token'])->delete();
            return redirect()->route('login')->with('Success', 'Password reset successfully!');
        }

        switch ($status) {
            case Password::INVALID_TOKEN:
                return back()->withInput()->withErrors(['token' => 'Invalid password reset token.']);
            case Password::INVALID_USER:
                return back()->withInput()->withErrors(['email' => 'Email address not found.']);
            default:
                return back()->withInput()->withErrors(['password' => 'Error occurred while resetting your password.']);
        }
    }
}
