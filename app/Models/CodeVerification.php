<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeVerification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function isOtpValid(string $otp) : bool
    {
        return $this->otp === $otp && $this->expires_at->isFuture();
    }
}
