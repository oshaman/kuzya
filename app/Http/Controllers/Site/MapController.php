<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Advantages;
use App\Models\Banner;
use App\Models\Building;
use App\Models\Review;
use App\Models\StaticPages;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index($static_page = null)
    {
        $include = [
            'model'      => StaticPages::find(1),
            'advantages' => Advantages::query()->where('in_main', 1)->get() ?? [],
            'reviews'    => Review::query()->where('is_visible', 1)->get() ?? [],
            'banners'    => Banner::query()->where('in_main', 1)->get() ?? [],
        ];
        if ($static_page) {
            dd($static_page);
        }
        return view('front.pages.index')->with($include);
    }

    public function getBuildings(Request $request, $offset = 0, $limit = 20000)
    {
        if($request->limit)
        {
            $limit = $request->limit;
        }
        $location = Building::query()->offset($offset)->skip($request->skip)->limit($limit)->get()->map(
        //$location = Building::query()->offset($offset)->limit($limit)->get()->map(
            function ($mod) {
                /** @var Building $mod */
                $mod->load('lang');
                $point = $mod->points[0];
                $build = [
                    'lng'=>round($point['pointX'], 6),
                    'lat'=>round($point['pointY'], 6),
                    'labels' => $mod->name
                ];

                return $build;
            });
        return response()->json(['location' => $location, 'total_count' => Building::count()]);


    }

    public function newsPage($model)
    {
        return view('front.pages.news_one')->with(compact('model'));
    }

}