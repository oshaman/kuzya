<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $models = Category::all();

        return view('admin.category.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Category();

        return view('admin.category.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.categoryi')]);

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
        /** @var Category $model */
        $model = Category::create($request->all());

        if (!$model->save()) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->update();
        Session::flash('flash_message', Lang::get('admins.category').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('categorys.index'));
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
     * @param Category $model
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $model)
    {
        $title = Lang::get('admins.category').' '."$model->name [$model->id]";

        return view('admin.category.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Category                  $model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $model)
    {
        if (!$model->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        Session::flash('flash_message', Lang::get('admins.category').' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('categorys.index'));
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
        Category::destroy($id);

        return response('1', 200);
    }

}
