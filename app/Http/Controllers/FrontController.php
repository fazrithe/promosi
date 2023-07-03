<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slides;

class FrontController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slide = Slides::orderby('created_at','desc')->get();
        $timer = Slides::orderby('created_at','desc')->first();
        return view('front', compact('slide','timer'));
    }
}
