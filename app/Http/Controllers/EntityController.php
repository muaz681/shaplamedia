<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityFv;
use App\Models\Entity;
use App\Models\Role;
use App\Models\Seo;
use App\Traits\TSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EntityController extends Controller
{
    use TSeo;
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
        // $people = Entity::orderBy('id', 'desc')->paginate(5);
        $people = Entity::where($queryWhere)->paginate($per_page);
        return view('admin.pages.people.list', compact('people','request'));
    }

    public function add()
    {
        $role   = Role::orderBy('id', 'desc')->get();
        $people = Entity::orderBy('id', 'desc')->get();
        
        return view('admin.pages.people.create')->with([
            'role'   => $role,
            'people' => $people,
            'fdata'  => new Entity(),
            'mdata'  => null
        ]); 
    }
    public function teamAdd()
    {
        $role   = Role::orderBy('id', 'desc')->get();
        $people = Entity::orderBy('id', 'desc')->get();
        return view('admin.pages.people.add')->with([ 
            'role'   => $role,
            'people' => $people,
            'fdata'  => new Entity(),
            'mdata'  => null
        ]);
    }
    public function edit(Request $request, $id)
    {  

       
        if (strlen($id) == 0) {
            return redirect()->back()->withErrors('No Profile id found');
        }

        $fdata = Entity::findOrfail($id);

        return view('admin.pages.people.create')->with([
            'fdata' => $fdata,
            'mdata' => null
        ]);
    }
    public function store(EntityFv $request)
    {  
        // return $request;
        //  dd($request->hasFile('image'));git 
        $id = $request->get('id');
     
        $attributes = [
            'name'          => $request->get('name'),
            'slug'          => $request->get('slug'),
            'description'   => $request->get('description'),
            'company'       => $request->get('company'),
            'dob'           => $request->get('dob'),
            'dead'          => $request->get('dead'),
            'years_active'  => $request->get('years_active'),
            'gender'        => $request->get('gender'),
            'remarks'       => $request->get('remarks'),
            'sort_by'       => $request->get('sort_by'),
            'is_active'     => $request->get('is_active') ? $request->get('is_active') : 'No',
            'modified_by'   => auth()->user()->id,
        ];
        if (!$id) {
            $attributes['create_by']  = auth()->user()->id;
        }
     
       
        try {
            if ($id) {
                $existing = Entity::findOrFail($id);
                if ($request->hasFile('image')) {
                    if (File::exists($existing->image)) {
                        File::delete($existing->image);
                    }
                    // dd($request);
                    $photo                  = $request->file('image')->getClientOriginalName();
                    $destination            = 'uploads/profile';
                    $request->file('image')->move($destination, $photo);
                    $attributes['image']    = $destination . '/' . $photo;
                 
                }
             
             
                $sumbit =  Entity::where('id', $id)->update($attributes);
                $existing->roles()->sync($request->role_id);
                $abledata = [
                    'data'      => $request,
                    'able_id'   => $id,
                    'able_type' => Entity::class,
                ];
                $this->seoPost($abledata);
            } else {

                if ($request->hasFile('image')) {
                    $photo                  = $request->file('image')->getClientOriginalName();
                    $destination            = 'uploads/profile';
                    $request->file('image')->move($destination, $photo);
                    $attributes['image']    = $destination . '/' . $photo;
                 
                }
                $insert = Entity::create($attributes);
                $insert->roles()->sync($request->role_id);
                $abledata = [
                    'data'      => $request,
                    'able_id'   => $insert->id,
                    'able_type' => Entity::class,
                ];
                $this->seoPost($abledata);
            }
            return redirect()->route('people.index')->with("Success", "Successfully save changed");
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

        // dump($id);
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
        $people = Entity::find($id);
        if (!is_null($people)) {
            //Delete Image
            if (File::exists($people->image)) {
                File::delete($people->image);
            }
            $people->delete();
        }
        return redirect('admin/entities')->with("success", "Profile deleted successfully.");
    }
}
