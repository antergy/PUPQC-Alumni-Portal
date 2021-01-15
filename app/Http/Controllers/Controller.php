<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 * @package App\Http\Controllers
 * @author  Cristian O. Balatbat <ian26balatbat@gmail.com>
 * @since   12/24/2020
 * @version 1.0
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Gets the requested action based on the request URL
     *
     * @param int $iKey
     * @return array|mixed
     */
    protected function getAction($iKey = 3)
    {
        $sRequestURL = $this->oRequest->path();
        return data_get(explode('/', $sRequestURL), $iKey);
    }

    /**
     * Gets the requested module based on the request URL
     *
     * @param int $iKey
     * @return array|mixed
     */
    protected function getModule($iKey = 2)
    {
        $sRequestURL = $this->oRequest->path();
        return data_get(explode('/', $sRequestURL), $iKey);
    }
}
