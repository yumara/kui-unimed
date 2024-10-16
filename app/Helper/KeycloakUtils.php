<?php

namespace App\Helper;

use Laravel\Socialite\Facades\Socialite;

class KeycloakUtils
{
    public static function driver()
    {
        return Socialite::driver('keycloak');
    }

    public static function redirectToLogInURL()
    {
        return self::driver()->redirect();
    }

    public static function redirectToLogOutURL(string $redirectUrl, string $idToken)
    {
        return redirect(self::driver()->getLogoutUrl(
            redirectUri: $redirectUrl,
            clientId: config('services.keycloak.client_id'),
            idTokenHint: $idToken,
        ));
    }

    public static function refreshToken(string $refreshToken)
    {
        return self::driver()->refreshToken(refreshToken: $refreshToken);
    }

    public static function userFromToken(string $accessToken)
    {
        return self::driver()->userFromToken(token: $accessToken);
    }
}
