<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class OTPNotification extends Mailable
{
    public $user;
    public $code;

    public function __construct(User $user, string $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    public function build($message)
    {
        $message
            ->to($this->user->email)
            ->subject('Login OTP' . config('app.name'))
            ->from('no-reply@cetri.io')
            ->view('mail.login-otp', [
                'user' => $this->user,
                'code' => $this->code,
            ]);
    }
}
