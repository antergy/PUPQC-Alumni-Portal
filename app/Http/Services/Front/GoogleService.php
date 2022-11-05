<?php


namespace App\Http\Services\Front;

use App\Libraries\Common\ResponseLib;
use App\Libraries\Common\SessionLib;
use Google\Service\Forms;
use Google\Service\Drive;
use App\Core\Admin\CoreAdminService;
use Google\Service\Gmail;
use Illuminate\Support\Facades\Redirect;

/**
 * Class GoogleService
 * @package App\Http\Services\Front
 */
class GoogleService extends CoreAdminService
{
    public $oClient = null;

    public function initializeClient($sRedirectUri)
    {
        $this->oClient = new \Google_Client();
        $this->oClient->setClientId(config('google.client_id'));
        $this->oClient->setClientSecret(config('google.client_secret'));
        $this->oClient->setRedirectUri($sRedirectUri);
        $this->oClient->setAccessType('offline');
        $this->oClient->setPrompt('consent');
    }

    public function setScopes($iUserType)
    {
        $this->oClient->addScope("email");
        $this->oClient->addScope("profile");
        if ($iUserType === 1 || $iUserType === 3) {
            $this->oClient->addScope(Gmail::MAIL_GOOGLE_COM);
            $this->oClient->addScope(Forms::FORMS_BODY);
            $this->oClient->addScope(Drive::DRIVE);
            $this->oClient->addScope(Drive::DRIVE_READONLY);
            $this->oClient->addScope(Drive::DRIVE_FILE);
            $this->oClient->addScope(Drive::DRIVE_METADATA_READONLY);
            $this->oClient->addScope(Drive::DRIVE_METADATA);
            $this->oClient->addScope(Drive::DRIVE_APPDATA);
        }
    }

    public function authenticate($iUserType, $sRedirectUri)
    {
        $this->initializeClient($sRedirectUri);
        $this->setScopes($iUserType);
        if (isset($_GET['code'])) {

            $token = $this->oClient->fetchAccessTokenWithAuthCode($_GET['code']);
            $sAccessToken = data_get($token, 'access_token', null);
            $sRefreshToken = data_get($token, 'refresh_token', null);

            $this->oClient->setAccessToken($sAccessToken);
            $this->oClient->refreshToken($sAccessToken);
            session()->push('google_access_token', $sAccessToken);
            session()->push('google_refresh_token', $sRefreshToken);
            return true;
        } else {
            return ResponseLib::formatSuccessResponse([
                'url' => $this->oClient->createAuthUrl()
            ], 'You are google authenticated');
        }
    }

    public function getUserClient($sUrl):\Google_Client
    {
        $atoken = data_get(SessionLib::getSession('google_access_token'), 0);
        $rtoken = data_get(SessionLib::getSession('google_refresh_token'), 0);
        $accessTokenJson = stripslashes($atoken);
        $refreshTokenJson = stripslashes($rtoken);
        $this->initializeClient($sUrl);
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
