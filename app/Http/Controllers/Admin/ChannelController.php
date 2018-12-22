<?php

namespace App\Http\Controllers\Admin;

use App\Models\Channel;
use App\Models\Partition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use Validator;
use Session;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Channel::with('lang')->get();

        return view('admin.channels.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Channel();
        $partitions = Partition::all()->pluck('name', 'id');

        return view('admin.channels.form')
            ->with([
                'model' => $model,
                'partitions' => $partitions,
                'title' => Lang::get('admins.channels') .' - '. Lang::get('admins.create')
            ]);
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
            'partition_id' => 'required|numeric|between:1,10000',
            'image' => 'nullable|string|max:255',

            'name_ru'              => 'nullable|string|max:150',

            'name_uk'              => 'nullable|string|max:150',
        ])->validate();

        $model = Channel::create($data);

        if (!$model->save()) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($data);
        }
        $model->fill($data)->update();
        $model->toggleStatus($request->get('active'));
        Session::flash('flash_message', Lang::get('admins.channels').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('channel.index'));
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
    public function edit(Channel $model)
    {
        $title = Lang::get('admins.channel').' '."$model->name [$model->id]";
        $partitions = Partition::all()->pluck('name', 'id');

        return view('admin.channels.form')->with(compact('title', 'model', 'partitions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $model)
    {
        $data = Validator::make($request->all(), [
            'active' => 'nullable|boolean',
            'priority' => 'nullable|numeric|between:1,100',
            'partition_id' => 'required|numeric|between:1,10000',
            'image' => 'nullable|string|max:255',

            'name_ru'              => 'nullable|string|max:150',

            'name_uk'              => 'nullable|string|max:150',
        ])->validate();

        if (!$model->update($data)) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($data);
        }
        $model->toggleStatus($request->get('active'));
        Session::flash('flash_message', Lang::get('admins.channel').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('channel.index'));
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
