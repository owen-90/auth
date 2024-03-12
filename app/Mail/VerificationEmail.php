<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class VerificationEmail extends Mailable
{
    public $user;
    public $verificationCode;

    public function __construct(User $user, string $verificationCode)
    {
        $this->user = $user;
        $this->verificationCode = $verificationCode;
    }

    public function build($message)
    {
        $user = $this->user;
        $verificationCode = $this->verificationCode;

        $message
            ->to($this->user->email)
            ->subject('Verify Your Email Address')
            ->from('no-reply@cetri.io')
            ->view('mail.email-verify', [
                'user' => $this->user,
                'verificationCode' => $this->verificationCode,
                'verificationUrl' => route('verify', ['email' => $user->email, 'code' => $verificationCode])
            ]);
    }
}
