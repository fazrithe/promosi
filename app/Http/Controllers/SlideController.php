<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlideController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('slide.index');
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file'          => 'required',
        ]);
        if($request->hasFile('file'))
        {
            $allowedfileExtension=['pdf','jpg','png','docx'];
            $files = $request->file('file');
            foreach($files as $file){
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $check=in_array($extension,$allowedfileExtension);
            }
        }

        return $request;
    }
}
