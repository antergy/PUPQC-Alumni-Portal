<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\Common\AuthLib;
use App\Libraries\Common\SessionLib;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers\Front
 */
class AuthController extends Controller
{
    public $oRequest;

    public function __construct(Request $oRequest)
    {
       $this->oRequest = $oRequest;
    }

    public function login()
    {
        $aParams = $this->oRequest->all();
        $sUsername = $aParams['username'];

        AuthLib::saveUserSession($sUsername, 1);

    }

    public function testSession()
    {
        dd(AuthLib::getUserSession());
    }

    public function logout()
    {
        SessionLib::deleteSession('uname');
    }
}
