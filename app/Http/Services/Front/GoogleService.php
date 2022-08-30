<?php


namespace App\Http\Services\Front;

use App\Libraries\Common\ResponseLib;
use App\Libraries\Common\SessionLib;
use Google\Service\Forms;
use Google\Service\Drive;
use App\Core\Admin\CoreAdminService;
use Illuminate\Support\Facades\Redirect;

class GoogleService extends CoreAdminService
{
    public $oClient = null;

    public function initializeClient()
    {
        $this->oClient = new \Google_Client();
        $this->oClient->setClientId(config('google.client_id'));
        $this->oClient->setClientSecret(config('google.client_secret'));
        $this->oClient->setRedirectUri(config('google.redirect_uri'));
        $this->oClient->setAccessType('offline');
        $this->oClient->setPrompt('consent');
    }

    public function setScopes()
    {
        $this->oClient->addScope("email");
        $this->oClient->addScope("profile");
        $this->oClient->addScope(Forms::FORMS_BODY);
        $this->oClient->addScope(Drive::DRIVE);
        $this->oClient->addScope(Drive::DRIVE_READONLY);
        $this->oClient->addScope(Drive::DRIVE_FILE);
        $this->oClient->addScope(Drive::DRIVE_METADATA_READONLY);
        $this->oClient->addScope(Drive::DRIVE_METADATA);
        $this->oClient->addScope(Drive::DRIVE_APPDATA);

    }

    public function authenticate()
    {
        $this->initializeClient();
        $this->setScopes();
        if (isset($_GET['code'])) {

            $token = $this->oClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $sAccessToken = data_get($token, 'access_token', null);
            $sRefreshToken = data_get($token, 'refresh_token', null);
//            $sRefreshToken = data_get($token, 'id_token', null);
            $this->oClient->setAccessToken($sAccessToken);
            $this->oClient->refreshToken($sAccessToken);
            session()->push('google_access_token', $sAccessToken);
            session()->push('google_refresh_token', $sRefreshToken);
//            session()->push('google_refresh_token', $sRefreshToken);
            return Redirect::to('https://pupqc.alumni-portal.com/admin/tracerFormGoogle');
        } else {
            return ResponseLib::formatSuccessResponse([
                'url' => $this->oClient->createAuthUrl()
            ], 'You are google authenticated');
        }
    }

    public function getUserClient():\Google_Client
    {
        $atoken = data_get(SessionLib::getSession('google_access_token'), 0);
        $rtoken = data_get(SessionLib::getSession('google_refresh_token'), 0);
        $accessTokenJson = stripslashes($atoken);
        $refreshTokenJson = stripslashes($rtoken);
        $this->initializeClient();
        $this->oClient->setAccessToken($accessTokenJson);
        $this->oClient->refreshToken($refreshTokenJson);

        if ($this->oClient->isAccessTokenExpired()) {
            // fetch new access token
            $this->oClient->fetchAccessTokenWithRefreshToken($refreshTokenJson);
            $this->oClient->setAccessToken($this->oClient->getAccessToken());
            session()->push('google_access_token', $this->oClient->getAccessToken());
        }

        return $this->oClient;
    }

    public function getRefreshToken()
    {

    }


}
