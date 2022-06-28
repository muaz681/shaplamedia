<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFV;
use App\Models\Role;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class RoleController extends Controller
{
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

        $role  = Role::where($queryWhere)->paginate($per_page);
        return view('admin.pages.role.list', compact('role','request'));

    }

    public function add()
    {
        return view('admin.pages.role.create')->with([
            'fdata' => null,
            'mdata' => null
        ]);
    }
    public function edit($id, Request $request)
    {
        $fdata    = Role::findOrfail($id);
        return view('admin.pages.role.create')->with([
            'fdata'     => $fdata,
            'mdata'     => null
        ]);
    }

    public function store(RoleFv $request)
    {
       

          $id = $request->get('id');
       
        $atttributes = [
            'title'        => $request->get('title'),
            'name'         => $request->get('name'),
            'is_important' => ($request->is_important) ? $request->is_important : 0,
            'is_character' => ($request->is_character) ? $request->is_character : 0,
            'sort_by'      => $request->get('sort_by'),
            // 'slug' => $request->get('slug')
        ];

        try {
            if ($id) {
                $data = Role::where('id', $id)->update($atttributes);
            } else {
                $date = Role::create($atttributes);
            }
            return redirect()->route('role.index')->with("Success", "Successfully save changed");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }




    public function delete($id)
    {
        //    dd($id);
        $role = Role::where('id', $id)->delete();
        return redirect('admin/roles')->with('success', 'tag has deleted successfully.');
    }
}
