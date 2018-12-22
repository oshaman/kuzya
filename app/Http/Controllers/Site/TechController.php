<?php

namespace App\Http\Controllers\Site;

use App\Models\Technical;
use App\Http\Controllers\Controller;

class TechController extends Controller
{
    public function index()
    {
        $tech = Technical::getTech();

        if(!$tech){
            abort(404);
        }

        return view('front.technical')->with(compact('tech'));
    }
}
