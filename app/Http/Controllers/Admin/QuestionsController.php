<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Question::all();

        return view('admin.questions.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Question();
        $model->all_category = Category::all()->pluck('name', 'id');

        return view('admin.questions.form')->with(['model' => $model, 'title' => Lang::get('admins.create').' '.Lang::get('admins.questiona')]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $model = (new Question())->fill($request->all());
        if (!$model->save()) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all());
        Session::flash('flash_message', ucfirst(Lang::get('admins.question')).' ['.$model->id.'] '.Lang::get('admins.created'));

        return redirect()->intended(route('questions.index'));
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
     * @param Question $model
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $model)
    {
        $model->all_category = Category::all()->pluck('name', 'id');
        $title = ucfirst(Lang::get('admins.question')).' '."$model->name [$model->id]";

        return view('admin.questions.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Question                  $model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $model)
    {
        if (!$model->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->toggleStatus($request->get('active'));

        Session::flash('flash_message', ucfirst(Lang::get('admins.question')).' ['.$model->id.'] '.Lang::get('admins.updated'));

        return redirect()->intended(route('questions.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Question $model
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $model)
    {
        $model->delete();

        return response('1', 200);
    }

}
