<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use Validator;
use Session;

class PartitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Partition::with('lang')->get();

        return view('admin.partition.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Partition();

        return view('admin.partition.form')->with(['model' => $model, 'title' => Lang::get('admins.partitions') .' - '. Lang::get('admins.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'active' => 'nullable|boolean',
            'priority' => 'nullable|numeric|between:1,100',

            'name_ru'              => 'nullable|string|max:150',


            'name_uk'              => 'nullable|string|max:150',
        ])->validate();

        $model = Partition::create($data);

        if (!$model->save()) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($data)->update();
        $model->toggleStatus($request->get('active'));
        Session::flash('flash_message', Lang::get('admins.partitions').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('partition.index'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Partition $model)
    {
        $title = Lang::get('admins.partition').' '."$model->name [$model->id]";

        return view('admin.partition.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partition $model)
    {
        $data = Validator::make($request->all(), [
            'active' => 'nullable|boolean',
            'priority' => 'nullable|numeric|between:1,100',

            'name_ru'              => 'nullable|string|max:150',


            'name_uk'              => 'nullable|string|max:150',
        ])->validate();

        if (!$model->update($data)) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($data);
        }
        $model->toggleStatus($request->get('active'));
        Session::flash('flash_message', Lang::get('admins.partition').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('partition.index'));
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
