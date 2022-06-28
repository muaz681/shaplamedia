<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaImageFv;
use App\Models\Media;
use App\Models\MediaImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaImageController extends Controller
{
    public function index()
    {
        $mediaimage = MediaImage::orderBy('id', 'desc')->get();
        return view('admin.pages.mediaimage.list', compact('mediaimage'));
    }
    public function add()
    {
		$media        = new MediaImage;
		return view('admin.pages.mediaimage.create')->with([
			'media'             => $media
		]);
    }

    public function edit($id, Request $request)
    {
        $media          = MediaImage::findOrfail($id);
        return view('admin.pages.mediaimage.create')->with([
            'media'             => $media,
        ]);
    }

	public function store(MediaImageFv $request)
    {
        // dd($request->all());
        $request->validate([
            'media_id' => 'required',
            // 'image'    => 'required',
        ]);
        $id = $request->get('id');
        $attributes = [
            'media_id'     => $request->get('media_id'),
        ];
        $media_id = $request->media_id;
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/mediaimage', $name);
                $data[] = $name;
            }
            // $attributes['image'] = json_encode($data);
            $te = $attributes['image'] = json_encode($data);
        }
        try {
            if ($id) {
                $data = [];
                if ($request->old_image) {
                    $data = $request->old_image;
                }
                // dd($data);
                if ($request->image) {
                    foreach ($request->file('image') as $file) {
                        array_push($data, $file->getClientOriginalName());
                    }
                }
                // else {
                //     array_pop($data);
                // }
                $attributes['image'] = json_encode($data);
                $data = MediaImage::where('id', $id)->update($attributes);
                // $data
            } else {
                $data = MediaImage::create($attributes);
            }
            return redirect()->route('mediaimage.index')->with("Success", "Successfully save changed");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }
    public function delete($id)
    {
        //dd($id);
        $mediaimage = MediaImage::find($id);
        $images = json_decode($mediaimage->image);
        if (!is_null($mediaimage)) {
            //Delete Image
            foreach ($images as $file) {
                unlink(public_path('uploads/mediaimage/') . $file);
            }
            // if (File::exists('uploads/mediaimage/' . $mediaimage->image)) {
            //     File::delete('uploads/mediaimage/' . $mediaimage->image);
            // }
            $mediaimage->delete();
        }
        return redirect('admin/media-image')->with("success", "Galery deleted successfully.");
    }
}
