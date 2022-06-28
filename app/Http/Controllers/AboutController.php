<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutFv;
use App\Models\About;
use App\Models\Seo;
use App\Traits\TSeo;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use TSeo;
    public function index()
    {
        $about = About::orderBy('id', 'desc')->get();
        return view('admin.pages.about.list', compact('about'));
    }

    public function add()
    {
        return view('admin.pages.about.create')->with([
            'fdata'  => new About(),
            'mdata'  => null
        ]);
    }
    public function edit($id, Request $request)
    {
        $fdata    = About::findOrfail($id);
        return view('admin.pages.about.create')->with([
            'fdata'   => $fdata,
            'mdata'   => null
        ]);
    }

    public function store(AboutFv $request)
    {
        // dd($request->request);
        $id = $request->get('id');
        $attributes = [
            'about_description'     => $request->get('about_description'),
            'message_chairman'      => $request->get('message_chairman'),
            'mission'               => $request->get('mission'),
            'vision'                => $request->get('vision'),

            // 'about_image'           => $request->get('about_image'),
            // 'chairman_image'        => $request->get('chairman_image'),
            'mission_image'         => $request->get('mission_image'),
            'vision_image'          => $request->get('vision_image'),

        ];
        if ($request->hasFile('about_image')) {
            // dd($request);
            $photo        = $request->file('about_image')->getClientOriginalName();
            $destination  = 'uploads/about';
            $request->file('about_image')->move($destination, $photo);
            $attributes['about_image']   = $destination . '/' . $photo;
        }
        if ($request->hasFile('chairman_image')) {
            // dd($request);
            $photo        = $request->file('chairman_image')->getClientOriginalName();
            $destination  = 'uploads/about';
            $request->file('chairman_image')->move($destination, $photo);
            $attributes['chairman_image']   = $destination . '/' . $photo;
        }
        if ($request->hasFile('mission_image')) {
            // dd($request);
            $photo        = $request->file('mission_image')->getClientOriginalName();
            $destination  = 'uploads/about';
            $request->file('mission_image')->move($destination, $photo);
            $attributes['mission_image']   = $destination . '/' . $photo;
        }
        if ($request->hasFile('vision_image')) {
            // dd($request);
            $photo        = $request->file('vision_image')->getClientOriginalName();
            $destination  = 'uploads/about';
            $request->file('vision_image')->move($destination, $photo);
            $attributes['vision_image']   = $destination . '/' . $photo;
        }

        try {
            // $destination = public_path('uploads/banner') . $request->image;
            if ($id) {
                $banner = About::findorFail($id);
                if (File::exists($banner->image)) {
                    File::delete($banner->image);
                }
                $data = About::where('id', $id)->update($attributes);
                $abledata = [
                    'data'      => $request,
                    'able_id'   => $id,
                    'able_type' => About::class,
                ];
                $this->seoPost($abledata);
            } else {
                // dd($attributes);
                $data = About::create($attributes);
                $abledata = [
                    'data'      => $request,
                    'able_id'   => $data->id,
                    'able_type' => About::class,
                ];
                $this->seoPost($abledata);
            }
            return redirect()->route('about.index')->with("Success", "Successfully save changed");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }
    public function Seogenarate($request)
    {
        $attributes = [
            'meta_title'        => $request->get('meta_title'),
            'meta_description'  => $request->get('meta_description'),
            'meta_keywords'     => $request->get('meta_keywords'),
            'canonical_tag'     => $request->get('canonical_tag'),
            'meta_type'         => $request->get('meta_type'),
            'meta_image'        => $request->get('meta_image'),
            'remarks'           => $request->get('remarks'),
            'sort_by'           => $request->get('sort_by'),
            'is_active'         => $request->get('is_active') ? $request->get('is_active') : 'No',
            'modified_by'       => auth('web')->user()->id,
        ];
        $id     = $request->get('id');
        $seo_id = $request->get('seo_id');
        if (!$id) {
            // $attributes['created_by']  = auth('web')->user()->id;
        }
        //dump($id);
        if ($seo_id) {
            $existing = Seo::findOrFail($seo_id);
            $data     =  Seo::where('id', $existing->id)->update($attributes);
            return $seo_id;
        } else {
            $data =  Seo::create($attributes);
            return $data->id;
        }
        return null;
    }

    public function delete($id)
    {
        //dd($id);
        $about = About::find($id);
        if (!is_null($about)) {
            //Delete image from folder 
            if (File::exists($about->image)) {
                File::delete($about->image);
            }
            $about->delete();
        }
        return redirect('admin/about')->with("success", "banner deleted successfully.");
    }
}
