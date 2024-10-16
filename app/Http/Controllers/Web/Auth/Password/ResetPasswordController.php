<?php

namespace App\Http\Controllers\Web\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Password\ResetPasswordRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function index(Request $request, string $token)
    {
        $email = $request->get('email');
        return view('auth.password.reset', ['token' => $token]);
    }

    public function store(ResetPasswordRequest $request, AuthenticationService $authenticationService)
    {
        $throttleKey = $request->throttleKey();
        $this->ensureIsNotRateLimited($request, $throttleKey, 10);

        try {
            $form = $request->validated();
            $status = $authenticationService->resetPassword(
                email: $form['email'],
                password: $form['password'],
                token: $form['token']);

            return back()->with(['status' => __($status)]);
        } catch (ValidationException $e) {
            RateLimiter::hit($throttleKey);
            throw $e;
        }
    }
}
