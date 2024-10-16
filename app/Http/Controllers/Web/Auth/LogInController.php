<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helper\RouteUtils;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogInRequest;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LogInController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(LogInRequest $request, AuthenticationService $service)
    {
        $throttleKey = $request->throttleKey();
        $this->ensureIsNotRateLimited($request, $throttleKey, 5);

        try {
            $form = $request->validated();
            $user = $service->login(email: $form['email'], password: $form['password']);

            auth()->login($user, $form['remember'] ?? false);
            session()->regenerate();

            return redirect()->intended(RouteUtils::getIndexRoute());
        } catch (ValidationException $e) {
            RateLimiter::hit($throttleKey);
            throw $e;
        }
    }
}
