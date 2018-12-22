<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advantages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class AdvantagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $models = Advantages::all();

        if (request()->has('visible')) {
            $visible = request()->get('visible');

            return view('admin.main.advantage.index')->with(compact('models', 'visible'));
        }

        return view('admin.main.advantage.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Advantages(
            [
                'user_id'    => \Auth::user()->id,
                'is_visible' => true,
            ]
        );

        return view('admin.main.advantage.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.advantages')]);

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
        if (!$model = Advantages::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->update();
        Session::flash('flash_message', Lang::get('admins.advantage').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('pages.edit',1));
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
     * @param Advantages $model
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Advantages $model)
    {
        $title = Lang::get('admins.advantage').' '."$model->name [$model->id]";

        return view('admin.main.advantage.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Advantages                $model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advantages $model)
    {
        if (!$model->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        Session::flash('flash_message', Lang::get('admins.advantage').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('pages.edit',1));
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
        Advantages::destroy($id);

        return response('1', 200);
    }

    public function switchPub(Advantages $model)
    {
//        dd($model->update(['in_main' => !$model->in_main]));
        if ($name = request()->get('name')) {
            $model->update([$name => !$model->{$name}]);

            return redirect()->route('advantage.index', ['visible' => $name]);
        }

        return response('отсутсвует переменная name', 418);
    }
}
