<?php


namespace App\Libraries\Common;


class AuthLib
{
    const USERNAME_SESSION_KEY = 'uname';
    const USER_LVL_SESSION_KEY = 'user_lvl';

    public static function saveUserSession($sUsername, $sUserLevel)
    {
        SessionLib::createSession(self::USERNAME_SESSION_KEY, $sUsername);
        SessionLib::createSession(self::USER_LVL_SESSION_KEY, $sUserLevel);
    }

    public static function getUserSession()
    {
        return [
            self::USERNAME_SESSION_KEY => SessionLib::getSession(self::USERNAME_SESSION_KEY),
            self::USER_LVL_SESSION_KEY => SessionLib::getSession(self::USER_LVL_SESSION_KEY)
        ];
    }

}
