<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

/**
 * Class HomePageController
 * @package App\Http\Controllers\Front
 */
class HomePageController extends Controller
{
    public function __construct()
    {
        // @TODO
    }

    /**
     * Returns the main page / set index of the app
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewMainPage()
    {
        return view('main');
    }
}
