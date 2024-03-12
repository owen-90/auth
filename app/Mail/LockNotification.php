<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class LockNotification extends Mailable
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build($messages)
    {
        $messages
            ->to($this->user->email)
            ->subject('Account Lock')
            ->from('no-reply@cetri.io')
            ->view('mail.lock-notification', [
                'user' => $this->user
            ]);
    }

}
