<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StockRequest;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Article::all();

        return view('admin.newss.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Article();

        return view('admin.newss.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.newsi')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StockRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StockRequest $request)
    {
        if (!$model = Article::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->save();
        $model->toggleStatus($request->get('active'));
        if (!$model->slug){
            $model->update(['slug'=>str_slug($model->name)]);
        }
        Session::flash('flash_message', ucfirst(Lang::get('admins.news')).' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $model
     *
     * @return \Illuminate\Http\Response
     */
    public function show($model)
    {
        return view('front.pages.news_one')->with(compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article $news
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($news)
    {
        $model = $news->load('lang');
        $title = ucfirst(Lang::get('admins.news')).' '."$model->name [$model->id]";


//        dd($model);

        return view('admin.newss.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StockRequest $request
     * @param   Article    $model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StockRequest $request, $model)
    {
        if (!$model->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->toggleStatus($request->get('active'));
        Session::flash('flash_message', ucfirst(Lang::get('admins.news')).' ['.$model->id.'] '.Lang::get('admins.updated'));
        if (!$model->slug){
            $model->update(['slug'=>str_slug($model->name)]);
        }
        return redirect()->intended(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $model
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($model)
    {
        try {
            $model->delete();

            return response('1', 200);
        } catch (\Exception $e) {
            return response('0', 418);
        }

    }
}
