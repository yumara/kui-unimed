<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

abstract class Controller
{
    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(Request $request, string $throttleKey, int $maxAttempts): void
    {
        if (!RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($throttleKey);
        throw ValidationException::withMessages([
            'page' => "Anda mencoba terlalu sering, silahkan tunggu selama $seconds detik untuk mencoba lagi.",
        ]);
    }
}
