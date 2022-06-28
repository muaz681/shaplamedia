<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagFv;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
	    $queryWhere = [];
	    $per_page = 5;
	    if($request->id) {
	    	$queryWhere['id'] = $request->id;
	    }
	    if($request->name) {
	    	$queryWhere[] = ['name', 'LIKE', '%'.$request->name.'%'];
	    }
        if($request->name) {
	    	$queryWhere[] = ['name', 'LIKE', '%'.$request->name.'%'];
	    }
	    if($request->per_page) {
	    	$per_page = $request->per_page;
	    }
        
        $tags = Tag::where($queryWhere)->paginate($per_page);
        return view('admin.pages.tag.list', compact('tags','request'));
    }

    public function add()
    {   

        return view('admin.pages.tag.create')->with([
            'fdata' => null,
            'mdata' => null
        ]);
    }

    public function edit($id, Request $request)
    {
        $fdata    = Tag::findOrfail($id);
        return view('admin.pages.tag.create')->with([
            'fdata'     => $fdata,
            'mdata'     => null
        ]);
    }
    public function store(TagFv $request)
    {   

        // return $request;
        $id = $request->get('id');
        $atttributes = [
            'name' => $request->get('title'),
            'slug' => $request->get('slug')
        ];

        try {
            if ($id) {
                $data = Tag::where('id', $id)->update($atttributes);
            } else {
                $date = Tag::create($atttributes);
            }
            return redirect()->route('tag.index')->with("Success", "Successfully save changed");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        //    dd($id);
        $tag = Tag::where('id', $id)->delete();
        return redirect('admin/tag')->with('success', 'tag has deleted successfully.');
    }
}
