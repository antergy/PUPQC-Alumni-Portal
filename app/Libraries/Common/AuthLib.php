<?php


namespace App\Libraries\Common;

use Illuminate\Support\Str;

class AuthLib
{
    const USER_ID = 'acc_id';
    const USER_FULL_NAME_KEY = 'acc_name';
    const USERNAME_KEY = 'acc_username';
    const USER_LVL_KEY = 'user_lvl';
    const USER_ACC_TYPE = 'acc_type';
    const USER_POSITION_KEY = 'at_desc';
    const USER_PROFILE_PIC_KEY = 'acc_picture';
    const USER_SESSION_ACTIVE_KEY = 'user_session_active';

    const USER_APP_KEY = 'user_app_key';
    const SECURITY_KEY_1 = 'security_key_1';
    const SECURITY_KEY_2 = 'security_key_2';
    const SECURITY_KEY_FULL = 'security_key_full';

    protected static function generateSecurityKey($sUsername)
    {
        $sSecureKey1 =  sprintf('%s_%s', $sUsername, Str::random(16));
        $sSecureKey2 =  sprintf('%s_%s', $sUsername, Str::random(16));
        $sFullSecureKey = "$sSecureKey1-$sSecureKey2";
        SessionLib::createSession(self::SECURITY_KEY_1, $sSecureKey1);
        SessionLib::createSession(self::SECURITY_KEY_2, $sSecureKey2);
        SessionLib::createSession(self::SECURITY_KEY_FULL, $sFullSecureKey);
    }

    public static function saveUserSession($aAccountInfo)
    {

        $iUserId = data_get($aAccountInfo, 'acc_id', '');
        $sFullname = data_get($aAccountInfo, 'acc_name', '');
        $sUsername = data_get($aAccountInfo, 'acc_username', '');
        $iUserLevel = data_get($aAccountInfo, 'acc_type', '');
        $sAccTypeDesc = data_get($aAccountInfo, 'at_desc', '');
        $sProfilePic = data_get($aAccountInfo, 'acc_picture', '');

        SessionLib::createSession(self::USER_ID, $iUserId);
        SessionLib::createSession(self::USER_FULL_NAME_KEY, $sFullname);
        SessionLib::createSession(self::USERNAME_KEY, $sUsername);
        SessionLib::createSession(self::USER_ACC_TYPE, $iUserLevel);
        SessionLib::createSession(self::USER_POSITION_KEY, $sAccTypeDesc);
        SessionLib::createSession(self::USER_PROFILE_PIC_KEY, $sProfilePic);
        SessionLib::createSession(self::USER_SESSION_ACTIVE_KEY, true);

        self::generateSecurityKey($sUsername);
    }

    public static function getUserSession()
    {
        return [
            self::USER_ID                 => SessionLib::getSession(self::USER_ID),
            self::USER_FULL_NAME_KEY      => SessionLib::getSession(self::USER_FULL_NAME_KEY),
            self::USERNAME_KEY            => SessionLib::getSession(self::USERNAME_KEY),
            self::USER_ACC_TYPE           => SessionLib::getSession(self::USER_ACC_TYPE),
            self::USER_POSITION_KEY       => SessionLib::getSession(self::USER_POSITION_KEY),
            self::USER_PROFILE_PIC_KEY    => SessionLib::getSession(self::USER_PROFILE_PIC_KEY),
            self::USER_SESSION_ACTIVE_KEY => SessionLib::getSession(self::USER_SESSION_ACTIVE_KEY),
            self::USER_APP_KEY            => SessionLib::getSession(self::SECURITY_KEY_1),
//            'google_token'                => SessionLib::getSession('google_token')
        ];
    }

    public static function deleteUserSession()
    {
        SessionLib::deleteSession(self::USER_ID);
        SessionLib::deleteSession(self::USER_FULL_NAME_KEY);
        SessionLib::deleteSession(self::USERNAME_KEY);
        SessionLib::deleteSession(self::USER_ACC_TYPE);
        SessionLib::deleteSession(self::USER_POSITION_KEY);
        SessionLib::deleteSession(self::USER_PROFILE_PIC_KEY);

        SessionLib::deleteSession(self::USER_SESSION_ACTIVE_KEY);
        SessionLib::deleteSession(self::SECURITY_KEY_1);
        SessionLib::deleteSession(self::SECURITY_KEY_2);
        SessionLib::deleteSession(self::SECURITY_KEY_FULL);
        SessionLib::deleteSession('google_access_token');
        SessionLib::deleteSession('google_refresh_token');
    }

}
