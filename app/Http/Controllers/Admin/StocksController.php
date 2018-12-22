<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Lang;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Stock::all();

        return view('admin.stocks.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Stock();

        return view('admin.stocks.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.stock')]);
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
        if (!$model = Stock::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->save();
        $model->toggleStatus($request->get('active'));
        Session::flash('flash_message', ucfirst(Lang::get('admins.stock')).' ['.$model->id.'] '.Lang::get('admins.created'));
        if (!$model->slug) {
            $model->update(['slug' => str_slug($model->name)]);
        }

        return redirect()->intended(route('stocks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Stock $model
     *
     * @return \Illuminate\Http\Response
     */
    public function show($model)
    {
        return view('front.pages.stock_one')->with(compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Stock $model
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($model)
    {

        $model->load('lang');
        $title = ucfirst(Lang::get('admins.stock')).' '."$model->name [$model->id]";

        return view('admin.stocks.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StockRequest $request
     * @param   Stock      $model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StockRequest $request, $model)
    {
        if (!$model->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->toggleStatus($request->get('active'));
        Session::flash('flash_message', ucfirst(Lang::get('admins.stock')).' ['.$model->id.'] '.Lang::get('admins.updated'));
        if (!$model->slug) {
            $model->update(['slug' => str_slug($model->name)]);
        }

        return redirect()->intended(route('stocks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Stock $model
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
