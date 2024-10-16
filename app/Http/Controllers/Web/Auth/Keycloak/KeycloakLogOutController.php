<?php

namespace App\Http\Controllers\Web\Auth\Keycloak;

use App\Helper\KeycloakUtils;
use App\Helper\RouteUtils;
use App\Http\Controllers\Controller;
use App\Models\Keycloak\KeycloakToken;
use Illuminate\Http\RedirectResponse;

class KeycloakLogOutController extends Controller
{
    public function index(): RedirectResponse
    {
        /* @var KeycloakToken $keycloakToken */
        $keycloakToken = session(KeycloakToken::SESSION_KEY);

        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        $redirectUrl = RouteUtils::getIndexRoute();
        if (!$keycloakToken) {
            return redirect()->to($redirectUrl);
        }

        return KeycloakUtils::redirectToLogOutURL($redirectUrl, $keycloakToken->idToken);
    }

    public function callbackHandler(): RedirectResponse
    {
        return redirect()->to(RouteUtils::getIndexRoute());
    }
}
