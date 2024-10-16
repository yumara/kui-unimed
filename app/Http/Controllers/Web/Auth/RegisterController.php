<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helper\RouteUtils;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\RateLimiter;

class RegisterController extends Controller
{
    public function index()
    {
        return view("auth.register");
    }

    public function store(RegisterRequest $request, AuthenticationService $service)
    {
        $throttleKey = $request->throttleKey();
        $this->ensureIsNotRateLimited($request, $throttleKey, 3);

        RateLimiter::hit($throttleKey);

        $form = $request->validated();
        $user = $service->register($form);

        auth()->login($user);
        session()->regenerate();

        return redirect()->intended(RouteUtils::getIndexRoute());
    }

}
