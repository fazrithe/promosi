<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slides;
use Illuminate\Support\Facades\Storage;

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
            'video_file'              => 'required',
            // 'company_logo_file' => 'required',
        ]);
        $videoFiles = [];

        if($request->hasFile('video_file'))
         {
            foreach($request->file('video_file') as $videoFile)
            {
                $file_name_ori  = $videoFile->getClientOriginalName();
                $file_name = time().rand(1,100).'.'.$videoFile->extension();
                // $file->move(public_path('files/video_promo'), $file_name);
                $filePath = 'files/video_promo/' . $file_name;
                Storage::disk('public')->put($filePath, file_get_contents($videoFile));
                // $url = Storage::disk('public')->url($filePath);
                $videoFiles[] = $file_name;
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
         }else{
            $companyLogoFiles[] = 0;
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
        }else{
            $promoLogoFiles[] = 0;
         }

         $file                      = new Slides();
         $file->file                = json_encode($videoFiles);
         $file->company_logo_file   = json_encode($companyLogoFiles);
         $file->promo_logo_file     = json_encode($promoLogoFiles);
         $file->description         = $request->description;
         $file->timer               = $request->timer;
         $file->save();

        return back()->with('success', 'Data Your files has been successfully added');
    }

  /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function destroy($id)
    {
        $post = Slides::findOrFail($id);

        $post->delete();

        return back()->with('success', 'Data Your files has been successfully deleted');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $data = Slides::find($id)->first();

        return view('slide.edit', compact('data'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'video_file'              => 'required',
            // 'company_logo_file' => 'required',
        ]);
        $videoFiles = [];

        if($request->hasFile('video_file'))
         {
            foreach($request->file('video_file') as $videoFile)
            {
                $file_name_ori  = $videoFile->getClientOriginalName();
                $file_name = time().rand(1,100).'.'.$videoFile->extension();
                // $file->move(public_path('files/video_promo'), $file_name);
                $filePath = 'files/video_promo/' . $file_name;
                Storage::disk('public')->put($filePath, file_get_contents($videoFile));
                // $url = Storage::disk('public')->url($filePath);
                $videoFiles[] = $file_name;
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
        }else{
            $companyLogoFiles[] = 0;
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
         }else{
            $promoLogoFiles[] = 0;
         }

         $file                      = Slides::where('id', $request->id)->first();
         $file->file                = json_encode($videoFiles);
         $file->company_logo_file   = json_encode($companyLogoFiles);
         $file->promo_logo_file     = json_encode($promoLogoFiles);
         $file->description         = $request->description;
         $file->timer               = $request->timer;
         $file->save();

        return back()->with('success', 'Data Your files has been successfully updated');
    }
}
