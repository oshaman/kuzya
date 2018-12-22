<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PagesRequest;
use App\Models\Article;
use App\Models\StaticPages;
use App\Models\Stock;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Lang;

class StaticPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = StaticPages::all();

        return view('admin.pages.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.form')->with([
            'model' => new StaticPages(),
            'title' => Lang::get('admins.create') . ' ' . Lang::get('admins.pagei')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PagesRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PagesRequest $request)
    {
//        dd($request);
        $page = new StaticPages();
        if (!$page->fill($request->all())->save()) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $page->saveSeo($request);
        $page->fill($request->all())->update();
        Session::flash('flash_message', ucfirst(Lang::get('admins.page')) . "  $page->name[$page->id] " . Lang::get('admins.created'));

        return redirect()->route('pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StaticPages $staticPages
     *
     * @return \Illuminate\Http\Response
     */
    public function show(StaticPages $page)
    {
        $include = [];
        switch ($page->id) {
            case 1:
                return redirect()->route('home');
                break;
            case 5:
                $stocks = Stock::query()->whereActive(1)->paginate(6);
                $include = ['stocks' => $stocks];
                break;
            case 6:
                $newss = Article::query()->whereActive(1)->paginate(6);
                $include = ['newss' => $newss];
                break;
        }

        return view('front.pages.' . ($page->template ?? $page->id))->with(
            array_merge(['model' => $page], $include)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StaticPages $staticPages
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(StaticPages $staticPages)
    {
        $model = $staticPages;
        $title = 'Страница ' . "$model->name [$model->id]";


        if (View::exists('admin.pages.chanks.' . $model->template)) {
            return view('admin.pages.chanks.' . $model->template)->with(compact('model', 'title'));
        }

        return view('admin.pages.form')->with(compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PagesRequest $request
     * @param  \App\Models\StaticPages $staticPages
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PagesRequest $request, StaticPages $staticPages)
    {
        $attr = $request->all();
        $staticPages->load('lang');
        $staticPages->published = Input::get('published', '0');
        $staticPages->update($attr);
        $staticPages->saveSeo($request);

        Session::flash('flash_message', Lang::get('admins.page') . " $staticPages->name[$staticPages->id] " . Lang::get('admins.updated'));

        return redirect()->route('pages.index');
    }

    /**
     * @param StaticPages $staticPages
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(StaticPages $staticPages)
    {
        try {
            $staticPages->delete();
        } catch (\Exception $e) {
        }

        return response('1', 200);
    }

    public function switchPub(StaticPages $staticPages)
    {
        $staticPages->update(['published' => !$staticPages->published]);

        return response('1', 200);
    }
}
