<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function add()
    {
        return view('admin.pages.banner.create');
    }
    //$existing->roles()->sync($request->role_id);
    //$role_id = Entity::where('id', $existing->entity_id);

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|max:150',

            'image'         => 'nullable',

        ]);
        $name = $request->name;

        $image = $request->image;


        $logo = new Logo();

        $logo->name = $name;


        if ($request->hasFile('image')) {
            // dd($request);
            $photo  = $request->file('image')->getClientOriginalName();
            $destination  = 'uploads/logo';
            $request->file('image')->move($destination, $photo);

            $logo->image   = $destination . '/' . $photo;

            // Banner::findOrFail($id)->update([
            //     'image'       => $destination . '/' . $photo,
            // ]);
        }
        //$category->filename = json_encode($data);


        $logo->save();

        return redirect()->route('logo.index');
    }
}
