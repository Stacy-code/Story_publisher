<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Story;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $items = Story::orderBy('created_at', 'desc')->paginate(5);
        return view('templates.frontend.stories', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('templates.frontend.createstory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function save(Request $request)
    {
        $result = $request->validate([

            'author' => 'required|max:32|min:2',
            'email' => 'required|max:128|email',
            'title' => 'required|max:255|min:10',
            'content' => 'required',

        ]);

        if ($result) {
            $result = Story::create($request->all());
        }
        return $result
            ? redirect()->route('stories')
            : back()->withInput();
    }
}
