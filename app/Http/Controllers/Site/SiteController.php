<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Advantages;
use App\Models\Banner;
use App\Models\Review;
use App\Models\StaticPages;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function __construct()
    {
        $this->middleware('tech');
    }

    public function index($static_page=null)
    {
        $include = [
            'model'=>StaticPages::find(1),
            'advantages' => Advantages::query()->where('in_main', 1)->get()??[],
            'reviews' => Review::query()->where('is_visible',1)->get()??[],
            'banners' => Banner::query()->where('in_main',1)->get()??[],
        ];
        if ($static_page){
            dd($static_page);
        }
        return view('front.pages.index')->with($include);
    }

    public function stockPage($model)
    {
        return view('front.pages.stock_one')->with(compact('model'));

    }

    public function newsPage($model)
    {
        return view('front.pages.news_one')->with(compact('model'));
    }

}
