<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TariffRequest;
use App\Models\Tariff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class TariffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Tariff::all();

        return view('admin.tariffs.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Tariff();

        return view('admin.tariffs.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.tariffa')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TariffRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TariffRequest $request)
    {
        if (!$model = Tariff::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->update();
        Session::flash('flash_message', ucfirst(Lang::get('admins.tariff')).' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('tariffs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Tariff $tariff
     *
     * @return \Illuminate\Http\Response
     */
    public function show($tariff)
    {
        return response($tariff->toJson(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tariff $tariff
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($tariff)
    {

        $model = $tariff->load('lang');
        $title = 'Тариф '."$model->name [$model->id]";

        return view('admin.tariffs.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TariffRequest $request
     * @param   Tariff      $tariff
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TariffRequest $request, $tariff)
    {
        if (!$tariff->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $tariff->toggleStatus($request->get('active'));

        Session::flash('flash_message', ucfirst(Lang::get('admins.tariff')).' ['.$tariff->id.'] '.Lang::get('admins.updated'));

        return redirect()->intended(route('tariffs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tariff $tariff
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($tariff)
    {
        try {
            $tariff->delete();

            return response('1', 200);
        } catch (\Exception $e) {
            return response('0', 418);
        }

    }
}
