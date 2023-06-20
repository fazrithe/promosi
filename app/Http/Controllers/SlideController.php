<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slides;

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
            'file'              => 'required',
            'company_logo_file' => 'required',
        ]);
        $files = [];
        if($request->hasfile('file'))
         {
            foreach($request->file('file') as $file)
            {
                $file_name_ori  = $file->getClientOriginalName();
                $file_name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('files/videoPromo'), $file_name);
                $files[] = $file_name;
            }
         }

         $companyLogoFiles = [];
         if($request->hasFile('company_logo_file'))
         {
            foreach($request->file('company_logo_file') as $companyFile)
            {
                $file_name_ori  = $companyFile->getClientOriginalName();
                $file_name_company = time().rand(1,100).'.'.$companyFile->extension();
                $companyFile->move(public_path('files/company_logo'), $file_name_company);
                $companyLogoFiles[] = $file_name_company;
            }
         }

         $promoLogoFiles = [];
         if($request->hasFile('company_promo_file'))
         {
            foreach($request->file('company_promo_file') as $promoFile)
            {
                $file_name_ori  = $promoFile->getClientOriginalName();
                $file_name_promo = time().rand(1,100).'.'.$promoFile->extension();
                $promoFile->move(public_path('files/promo_logo'), $file_name_promo);
                $promoLogoFiles[] = $file_name_promo;
            }
         }

         $file                      = new Slides();
         $file->file                = json_encode($files);
         $file->company_logo_file   = json_encode($companyLogoFiles);
         $file->promo_logo_file     = json_encode($promoLogoFiles);
         $file->description         = $request->description;
         $file->save();

        return back()->with('success', 'Data Your files has been successfully added');
    }
}
