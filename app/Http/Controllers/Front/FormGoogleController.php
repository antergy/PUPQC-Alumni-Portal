<?php


namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\Front\GoogleService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use App\Libraries\Common\SessionLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FormGoogleController extends Controller
{
    /**
     * Holds the instance of Illuminate\Http\Request
     * @var Request
     */
    public $oRequest;

    public $oGoogleClient;

    /**
     * AccountAdminController constructor.
     * @param Request $oRequest
     */
    public function __construct(Request $oRequest)
    {
        $this->oRequest = $oRequest;
        $this->oGoogleClient = new GoogleService();
        LogLib::initTraceId('form_google');
    }

    public function checkGoogleAuth()
    {
        $sGoogleToken = SessionLib::getSession('google_access_token');
        if (empty($sGoogleToken)) {
            return $this->oGoogleClient->authenticate();
        } else {

            return ResponseLib::formatSuccessResponse(true, 'You are finally redirected');
        }
    }

    public function getForms()
    {
        $client = $this->oGoogleClient->getUserClient();
        $service = new \Google\Service\Drive($client);
        $res = $service->files->listFiles(['q'      => "mimeType='application/vnd.google-apps.form'",
                                           'fields' => 'files(*)'])->getFiles();
        return json_decode(json_encode($res), true);
    }
}
