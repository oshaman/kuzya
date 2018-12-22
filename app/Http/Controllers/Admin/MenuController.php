<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Models\StaticPages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Menu::query();
        $models = $models->with('childs');
        $models = $models->whereNull('parent_id');

        return view('admin.menu.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = StaticPages::all();
        $title = Lang::get('admins.create').' '.Lang::get('admins.menu');
        $model = new Menu();
        $parents = Menu::all();

        return view('admin.menu.form')->with(compact('pages', 'title', 'model', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        if (!$menu = Menu::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $menu->fill($request->all())->update();
        $menu->toggleStatus($request->get('approved'));
        Session::flash('flash_message', ucfirst(Lang::get('admins.menu')).' ['.$menu->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('menus.index'));
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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//                dd(Menu::getActive());

        $pages = StaticPages::all();
        $model = Menu::find($id);
        $title = 'Меню '."$model->name [$id]";
        $parents = Menu::all();

        return view('admin.menu.form')->with(compact('pages', 'title', 'model', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuRequest $request
     * @param  int        $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }

        $menu->toggleStatus($request->get('approved'));
        Session::flash('flash_message', ucfirst(Lang::get('admins.menu')).' ['.$id.'] '.Lang::get('admins.updated'));

        return redirect()->intended(route('menus.index'));
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
        Menu::destroy($id);

        return response('1', 200);
    }
}
