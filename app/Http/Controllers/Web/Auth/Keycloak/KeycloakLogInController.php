<?php

namespace App\Http\Controllers\Web\Auth\Keycloak;

use App\Helper\RouteUtils;
use App\Helper\KeycloakUtils;
use App\Http\Controllers\Controller;
use App\Models\Keycloak\KeycloakToken;
use App\Models\Keycloak\KeycloakUser;
use App\Services\AuthenticationService;
use Illuminate\Http\RedirectResponse;

class KeycloakLogInController extends Controller
{
    public function index(): RedirectResponse
    {
        // This action resulted to redirect to keycloak login page
        // after the user successfully logged in,
        // callbackHandler() will be called
        return KeycloakUtils::redirectToLogInURL();
    }

    public function callbackHandler(AuthenticationService $service): RedirectResponse
    {
        // retrieve keycloak tokens and user
        $socialiteUser = KeycloakUtils::driver()->user();
        $keycloakToken = KeycloakToken::fromArray($socialiteUser->accessTokenResponseBody);
        $keycloakUser = KeycloakUser::fromArray($socialiteUser->user);

        $user = $service->loginKeycloak($keycloakUser);
        auth()->login($user);

        // store keycloak tokens and user to session
        session()->put(KeycloakToken::SESSION_KEY, $keycloakToken);
        session()->put(KeycloakUser::SESSION_KEY, $keycloakUser);
        session()->put('auth_provider', 'keycloak');
        session()->regenerate();

        // check if there is target url in session
        // this used when middleware failed to authenticate user
        // so the user will be redirected to the intended url
        return redirect()->intended(RouteUtils::getIndexRoute());
    }
}
