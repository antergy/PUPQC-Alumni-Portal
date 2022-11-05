<?php


namespace App\Http\Controllers\Front;

use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Http\Services\Front\GoogleService;
use App\Libraries\Common\LogLib;
use App\Libraries\Common\ResponseLib;
use App\Libraries\Common\SessionLib;
use Google\Service\Drive\DriveFile;
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
        $sRedirectUri = 'https://pupqc.alumni-portal.com/checkGoogleAuth';
        $sGoogleToken = SessionLib::getSession('google_access_token');
        if (empty($sGoogleToken)) {
            if ($this->oGoogleClient->authenticate(1, $sRedirectUri) === true) {
                return Redirect::to('https://pupqc.alumni-portal.com/admin/tracerFormGoogle');
            } else {
                return $this->oGoogleClient->authenticate(1, $sRedirectUri);
            }
        } else {
            return ResponseLib::formatSuccessResponse(true, 'You are finally redirected');
        }
    }

    public function getForms()
    {
        $sRedirectUri = 'https://pupqc.alumni-portal.com/checkGoogleAuth';
        $client = $this->oGoogleClient->getUserClient($sRedirectUri);
        $service = new \Google\Service\Drive($client);
        $res = $service->files->listFiles(['q'      => "mimeType='application/vnd.google-apps.form'",
                                           'fields' => 'files(*)'])->getFiles();

        return json_decode(json_encode($res), true);
    }

    public function getFormResponses()
    {
        $sRedirectUri = 'https://pupqc.alumni-portal.com/checkGoogleAuth';
        $client = $this->oGoogleClient->getUserClient($sRedirectUri);
        $service = new \Google\Service\Forms($client);
        $res = $service->forms_responses->listFormsResponses('1_4SOBbBHO5dJtYR9VlHcsw5c1qhKk_71P-NAVb5QLvg');
        $aCont = [];
        foreach ($res['responses'] as $response) {
            if ($response->respondentEmail === 'ian26balatbat@gmail.com') {
                array_push($aCont, $response);
            }
        }
        return json_decode(json_encode($res), true);
    }

    public function createForm()
    {
        try {
            /** Prepares the parameters */
            $sGoogleFormName = $this->oRequest->input('google_form_name', '');

            // Working create form
            $sRedirectUri = 'https://pupqc.alumni-portal.com/checkGoogleAuth';
            $client = $this->oGoogleClient->getUserClient($sRedirectUri);
            $service = new \Google\Service\Drive($client);
            $fileMetadata = new \Google\Service\Drive\DriveFile();
            $fileMetadata->setName($sGoogleFormName);
//            $fileMetadata->setDescription($sGoogleFormName);
            $fileMetadata->setMimeType('application/vnd.google-apps.form');

            /** Executes the request */
            $file = $service->files->create($fileMetadata);
            $aFileResult = ($service->files->get($file->getId(), ['fields' => 'webViewLink']));

            return ResponseLib::formatSuccessResponse($aFileResult, 'Successfully created a google form');
        } catch (\Throwable $oException) {
            return ResponseLib::formatErrorResponse($oException);
        }

    }
}
