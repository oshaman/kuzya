<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BuildingRequest;
use App\Models\Building;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Lang;

class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Building::all();

        return view('admin.map.buildings.index')->with(compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Building();

        return view('admin.map.buildings.form')->with([
            'model' => $model,
            'title' => Lang::get('admins.create') . ' ' . Lang::get('admins.building')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BuildingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingRequest $request)
    {

        if (!$model = Building::create($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        $model->fill($request->all())->update();
        Session::flash('flash_message', ucfirst(Lang::get('admins.building')) . ' [' . $model->id . '] .' . Lang::get('admins.created'));

        return redirect()->intended(route('pages.edit', 3));
    }

    /**
     * Display the specified resource.
     *
     * @param Building $review
     *
     * @return void
     */
    public function show(Building $review)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Building $review
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $review)
    {
        $model = $review;
        $title = Lang::get('admins.building') . ' ' . "$model->name [$model->id]";

        return view('admin.map.buildings.form')->with(compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BuildingRequest $request
     * @param   Building $review
     *
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingRequest $request, Building $review)
    {
        if (!$review->update($request->all())) {
            return redirect()->back()->withErrors(Lang::get('admins.error_save'))->withInput($request->all());
        }
        Session::flash('flash_message', ucfirst(Lang::get('admins.building')) . ' [' . $review->id . '] ' . Lang::get('admins.created'));

        return redirect()->intended(route('pages.edit', 3));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Building $review
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Building $review)
    {
        $review->delete();

        return response('1', 200);
    }

    public function switchPub(Building $model)
    {
        if ($name = request()->get('name')) {
            $model->update([$name => !$model->{$name}]);

            return redirect()->route('buildings.index', ['visible' => $name]);
        }

        return response('отсутсвует переменная name', 418);
    }

    public function parseCSV(Request $request)
    {
        if ($request->hasFile('file_csv')) {
            $file_content = file_get_contents($request->file('file_csv')->getPathname());
            $stroks = explode("\n", substr($file_content, strpos('a', $file_content)));
            array_shift($stroks);
            array_pop($stroks);
            $data = array_map(function ($el) {
                return explode("\t", $el);
            }, $stroks);

            array_walk($data, function ($el) {
                $building = Building::query()->where('points', json_encode(array_map(function ($poin) {
                    $point['pointY'] = round($poin[0], 5);
                    $point['pointX'] = round($poin[1], 5);
                    return $point;
                }, json_decode($el[1]))))->first();

                if ($building) {

                } else {
                    $building = new Building();
                    $building->load('lang');
                    $building->points = array_map(function ($poin) {
                        $point['pointY'] = round($poin[0], 5);
                        $point['pointX'] = round($poin[1], 5);
                        return $point;
                    }, json_decode($el[1]));
                    $building->save();
                }
                $building->setAttribute('name_ru', $el[0]);
                $building->setAttribute('name_uk', $el[0]);
                return $building;
            });

            return response()->json(['success' => 'Сохранено'], 200);
        }
        return response()->json(['error' => 'Файл не соответствует'], 418);
    }
}
