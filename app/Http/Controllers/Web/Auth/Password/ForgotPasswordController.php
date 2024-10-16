<?php

namespace App\Http\Controllers\Web\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Password\ForgotPasswordRequest;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\RateLimiter;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.password.forgot');
    }

    public function store(ForgotPasswordRequest $request, AuthenticationService $authenticationService)
    {
        $throttleKey = $request->throttleKey();
        $this->ensureIsNotRateLimited($request, $throttleKey, 1);

        RateLimiter::hit($throttleKey);

        $form = $request->validated();
        $status = $authenticationService->sendResetPasswordEmail($form['email']);

        return back()->with(['status' => __($status)]);
    }
}
