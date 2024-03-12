<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AccountLock
{

    public function handle($request, Closure $next)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->isLocked()) {
            return response()->json(['message' => 'Account locked. Please try again later.'], 423);
        }

        // Increment login attempts

        if ($user) {
            $user->update(['login_attempts' => $user->login_attempts + 1]);
        }

        return $next($request);
    }

}
