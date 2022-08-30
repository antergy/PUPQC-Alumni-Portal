<?php


namespace App\Libraries\Common;


use Illuminate\Support\Facades\Redirect;

class GoogleLib
{
    public static function checkAccessToken()
    {

    }

    public static function registerAccount()
    {
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope("email");
        $client->addScope("profile");
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            // To retrieve user details
            $service = new \Google\Service\Oauth2($client);
            $userFromGoogle = $service->userinfo->get();
            dd($userFromGoogle);

        } else {
            return Redirect::to($client->createAuthUrl());
        }
    }
}
