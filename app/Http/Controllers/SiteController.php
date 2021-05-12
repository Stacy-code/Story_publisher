<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class SiteController
 *
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('templates.site');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);


        //$request->all();
        return back()->withInput();
    }
}
