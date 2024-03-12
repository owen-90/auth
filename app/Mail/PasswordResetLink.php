<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class PasswordResetLink extends Mailable
{
    public $user;
    public $url;

    public function __construct(User $user, string $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function build($message)
    {
        $message
            ->to($this->user->email)
            ->subject('Password Reset')
            ->from('no-reply@cetri.io')
            ->view('mail.password-reset', [
                'user' => $this->user,
                'resetUrl' => $this->url,
            ]);
    }
}
