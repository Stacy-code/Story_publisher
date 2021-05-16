<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class HomeController
 */
class HomeController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('templates.frontend.home');
    }
}
