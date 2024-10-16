<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helper\RouteUtils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogOutController extends Controller
{
    public function __invoke(Request $request)
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->intended(RouteUtils::getIndexRoute());
    }
}
