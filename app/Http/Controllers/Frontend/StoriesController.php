<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Story;
use Illuminate\Http\Request;

class StoriesController extends Controller
{

    /**
     * @var Story $model
     */
    public $model;

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




    public function rate(Request $request)
    {
        $result = [
            'success' => false,
            'msg' => 'Не вдалося проголосувати!'
        ];


        $rateId = $request->cookie('rate.id');


        if($rateId === $request->post('id')){
            $result = [
                'success' => false,
                'msg' => 'Не вдалося проголосувати!'
            ];
        }
        else{
            if (!empty($request->post('id'))) {

                $storyModel = Story::where('id', $request->post('id'))->first();

                if($storyModel instanceof Story){
                    $rateId = cookie('rate.id', $request->post('id'));

                    try {
                        switch ($request->post('button_type')){
                            case 'like' :

                                $storyModel->like_count += 1;
                                $storyModel->save();
                                $result['msg'] = 'Ви поставили лайк!';
                                $result['success'] = true;
                                $result['count'] = $storyModel->like_count;
                                break;
                            case 'dislike' :
                                $storyModel->dislike_count += 1;
                                $storyModel->save();
                                $result['msg'] = 'Ви поставили дизлайк!';
                                $result['success'] = true;
                                $result['count'] = $storyModel->dislike_count;
                                break;
                        }
                    }
                    catch (\Exception $e){
                        dd($e->getMessage());
                    }


                }
                else{
                    $result['msg'] = 'Записи не существует!';
                }
            }
        }



        return response()->json($result);

    }
}
