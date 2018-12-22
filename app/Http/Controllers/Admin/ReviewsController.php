<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Review::all();

        return view('admin.main.reviews.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Review(
            [
                'user_id'    => \Auth::user()->id,
                'is_visible' => true,
            ]
        );

        return view('admin.main.reviews.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.reviewa')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$model = Review::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->update();
        Session::flash('flash_message', ucfirst(Lang::get('admins.review')).' ['.$model->id.'] .'.Lang::get('admins.created'));

        return redirect()->intended(route('reviews.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Review $review
     *
     * @return void
     */
    public function show(Review $review)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Review $review
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        $model = $review;
        $title = 'Отзыв '."$model->name [$model->id]";

        return view('admin.main.reviews.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param   Review                  $review
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        if (!$review->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        Session::flash('flash_message', ucfirst(Lang::get('admins.review')).' ['.$review->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('reviews.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Review $review
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response('1', 200);
    }

    public function switchPub(Review $model)
    {
        if ($name = request()->get('name')) {
            $model->update([$name => !$model->{$name}]);

            return redirect()->route('reviews.index', ['visible' => $name]);
        }

        return response('отсутсвует переменная name', 418);
    }
}
