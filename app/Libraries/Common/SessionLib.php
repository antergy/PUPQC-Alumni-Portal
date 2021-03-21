<?php


namespace App\Libraries\Common;


class SessionLib
{

    public static function createSession($sKey, $sValue)
    {
        session()->put($sKey, $sValue);
    }

    public static function getSession($sKey)
    {
        return session()->get($sKey);
    }

    public static function deleteSession($sKey)
    {
        session()->forget($sKey);
    }
}
