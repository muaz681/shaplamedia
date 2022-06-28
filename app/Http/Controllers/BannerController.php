<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerFv;
use App\Models\Banner;
use App\Models\Seo;
use App\Models\User;
use App\Traits\TSeo;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
{
    use TSeo;

    public function index(Request $request)
    {
	    $queryWhere = [];
	    $per_page = 5;
	    if($request->id) {
	    	$queryWhere['id'] = $request->id;
	    }
	    if($request->title) {
	    	$queryWhere[] = ['title', 'LIKE', '%'.$request->title.'%'];
	    }
        if($request->title) {
	    	$queryWhere[] = ['title', 'LIKE', '%'.$request->title.'%'];
	    }
	    if($request->per_page) {
	    	$per_page = $request->per_page;
	    }
        // $banner = Banner::orderBy('id', 'desc')->paginate(4);
        $banner = Banner::where($queryWhere)->paginate($per_page);
        return view('admin.pages.banner.list', compact('banner','request'));
    }

    public function add()
    {
        return view('admin.pages.banner.create')->with([
            'fdata'  => new Banner(),
            'mdata'  => null
        ]);
    }
    public function edit($id, Request $request)
    {
        $fdata    = Banner::findOrfail($id);
        return view('admin.pages.banner.create')->with([
            'fdata'   => $fdata,
            'mdata'   => null
        ]);
    }

    public function store(BannerFv $request)
    {
        // dd($request->request);
        $id = $request->get('id');
        $attributes = [
            'title'                 => $request->get('title'),
            'media_id'              => $request->get('media_id'),
            'description'           => $request->get('description'),
            'short_description'     => $request->get('short_description'),
            'year'                  => $request->get('year'),
            'age_limit'             => $request->get('age_limit'),
            'cinebazurl'            => $request->get('cinebazurl'),
            'trailler_button_url'   => $request->get('trailler_button_url'),
        ];
        if ($request->hasFile('image')) {
            // dd($request);
            $photo        = $request->file('image')->getClientOriginalName();
            $destination  = 'uploads/banner';
            $request->file('image')->move($destination, $photo);
            $attributes['image']   = $destination . '/' . $photo;
        }
        try {
            // $destination = public_path('uploads/banner') . $request->image;
            if ($id) {
                $banner = Banner::findorFail($id);
                // if (File::exists($banner->image)) {
                //     File::delete($banner->image);
                // }
                $data = Banner::where('id', $id)->update($attributes);
                $abledata = [
                    'data'      => $request,
                    'able_id'   => $id,
                    'able_type' => Banner::class,
                ];
                $this->seoPost($abledata);
            } else {
                // dd($attributes);
                $data = Banner::create($attributes);
                $abledata = [
                    'data'      => $request,
                    'able_id'   => $data->id,
                    'able_type' => Banner::class,
                ];
                $this->seoPost($abledata);
            }
            return redirect()->route('banner.index')->with("Success", "Successfully save changed");
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
        $banner = Banner::find($id);
        if (!is_null($banner)) {
            //Delete image from folder 
            if (File::exists($banner->image)) {
                File::delete($banner->image);
            }
            $banner->delete();
        }
        return redirect('admin/banner')->with("success", "banner deleted successfully.");
    }
}
