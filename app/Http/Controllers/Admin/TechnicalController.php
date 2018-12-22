<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TechnicalRequest;
use App\Models\Technical;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use Session;

class TechnicalController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Technical::all();

        return view('admin.technical.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Technical $model
     * @return \Illuminate\Http\Response
     */
    public function edit(Technical $model)
    {
        $model->load('lang');
        $title = ucfirst(Lang::get('admins.technical')).' '."$model->title [$model->id]";

        return view('admin.technical.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TechnicalRequest  $request
     * @param  Technical  $model
     * @return \Illuminate\Http\Response
     */
    public function update(TechnicalRequest $request, $model)
    {
        if (!$model->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        Session::flash('flash_message', ucfirst(Lang::get('admins.technical')).' ['.$model->id.'] '.Lang::get('admins.updated'));
        $model->toggleStatus($request->get('active'));
//        if (!$model->slug) {
//            $model->update(['slug' => str_slug($model->name)]);
//        }

        return redirect()->intended(route('technical.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
