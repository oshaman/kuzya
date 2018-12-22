<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Banner::all();

        return view('admin.main.banners.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Banner(['in_main' => true,]);

        return view('admin.main.banners.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.bannera')]);
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
        if (!$model = Banner::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->update();
        Session::flash('flash_message', ucfirst(Lang::get('admins.banner')).' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('banners.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Banner $model
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $model)
    {
        $title = ucfirst(Lang::get('admins.banner')).' '."[$model->id]";

        return view('admin.main.banners.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Banner                    $model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $model)
    {
        if (!$model->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        Session::flash('flash_message', ucfirst(Lang::get('admins.banner')).' ['.$model->id.'] '.Lang::get('admins.updated'));

        return redirect()->intended(route('banners.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::destroy($id);

        return response('1', 200);
    }

    public function switchPub($model)
    {
        $model->update(['in_main' => !$model->in_main]);

        return redirect()->route('banners.index');
    }
}
