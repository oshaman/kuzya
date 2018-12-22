<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Service::all();

        return view('admin.services.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Service();

        return view('admin.services.form')->with(['model' => $model,
                                                  'title' => Lang::get('admins.create').' '.Lang::get('admins.service')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServiceRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        if (!$model = Service::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->update();
        Session::flash('flash_message', ucfirst(Lang::get('admins.service')).' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('services.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Service $service
     *
     * @return \Illuminate\Http\Response
     */
    public function show($service)
    {
        return response($service->toJson(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Service $service
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($service)
    {

        $model = $service;
        $title = 'Сервис '."$model->name [$model->id]";

        return view('admin.services.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceRequest $request
     * @param   Service $service
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $service)
    {
        if (!$service->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }

        $service->toggleStatus($request->get('active'));

        Session::flash('flash_message', ucfirst(Lang::get('admins.service')).' ['.$service->id.'] '.Lang::get('admins.updated'));

        return redirect()->intended(route('services.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($service)
    {
        try {
            $service->delete();

            return response('1', 200);
        } catch (\Exception $e) {
            return response('0', 418);
        }

    }
}
