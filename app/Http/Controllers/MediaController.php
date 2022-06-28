<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaFv;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Media;
use App\Models\Role;
use App\Models\Seo;
use App\Traits\TSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    use TSeo;

    public function index(Request $request)
    {
	    $queryWhere = [];
	    $per_page = 5;
	    if($request->id) {
	    	$queryWhere['id'] = $request->id;
	    }
	    if($request->media_type) {
	    	$queryWhere['media_type'] = $request->media_type;
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
	    if($request->release_date) {
		    $queryWhere['release_date'] = $request->release_date;
	    }
	    $movie = Media::where($queryWhere)->paginate($per_page);
	    return view('admin.pages.movie.list', compact('movie', 'request'));
    }

    public function add()
    {
        $movie = Media::orderBy('id', 'desc')->get();
        $role = Role::orderBy('sort_by', 'ASC')->get();
        $people = Entity::orderBy('name', 'desc')->get();
        
        $p = [];
        foreach ($people as $list) {
            $p[$list->id] = $list->name;
        }
        $category = Category::orderBy('id', 'desc')->get();
        $fdata = new Media();
        
        // $category = Category::orderBy('id', 'desc')->get();
        return view('admin.pages.movie.create')->with([
            'fdata'             => $fdata,
            'mdata'             => null,
            'category'          => $category,
            'people'            => $p,
            'movie'             => $movie,
            'role'              => $fdata->getEntitiesByOtherRoles([1,2,4,5,6,7,8,12]),
            'directors'         => $fdata->getEntitiesByRole(2),
            'producers'         => $fdata->getEntitiesByRole(4),
            'casts'             => $fdata->getEntitiesByRole(1),
            'writers'           => $fdata->getEntitiesByRole(5),
            'musicians'         => $fdata->getEntitiesByRole(6),
            'cinematographers'  => $fdata->getEntitiesByRole(7),
            'distributors'      => $fdata->getEntitiesByRole(8),
            'screenplay'        => $fdata->getEntitiesByRole(12),
        ]);
        //return view('admin.pages.movie.create', compact('category'));
    }

    public function edit($id, Request $request)
    {
        $movie = Media::orderBy('id', 'desc')->get();
        $fdata    = Media::findOrfail($id);
        $category = Category::orderBy('id', 'desc')->get();
        $role = Role::orderBy('id', 'desc')->get();
        $people = Entity::orderBy('name', 'ASC')->get();
        
        $p = [];
        foreach ($people as $list) {
            $p[$list->id] = $list->name;
        }
        return view('admin.pages.movie.create')->with([
            'fdata'             => $fdata,
            'category'          => $category,
            'movie'             => $movie,
            'role'              => $fdata->getEntitiesByOtherRoles([1,2,4,5,6,7,8,12]),
            'people'            => $p,
            'directors'         => $fdata->getEntitiesByRole(2),
            'producers'         => $fdata->getEntitiesByRole(4),
            'casts'             => $fdata->getEntitiesByRole(1),
            'writers'           => $fdata->getEntitiesByRole(5),
            'musicians'         => $fdata->getEntitiesByRole(6),
            'cinematographers'  => $fdata->getEntitiesByRole(7),
            'distributors'      => $fdata->getEntitiesByRole(8),
            'screenplay'        => $fdata->getEntitiesByRole(12),
        
        ]);

        //return view('admin.pages.movie.edit', $data);
    }
    public function store(MediaFv $request)
    {
        // return $request;
        // return $request;
        $id = $request->get('id');
        $attributes = [
            'name'                  => $request->get('name'),
            'slug'                  => $request->get('slug'),
            'description'           => $request->get('description'),
            'link'                  => $request->get('link'),
            'cinebazurl'            => $request->get('cinebazurl'),
            'parent_id'             => $request->get('parent_id'),
            'media_type'            => $request->get('media_type'),
            'ratings'               => $request->get('ratings'),
            'run_time'              => $request->get('run_time'),
            'release_date'          => $request->get('release_date'),
            'remarks'               => $request->get('remarks'),
            'sort_by'               => $request->get('sort_by'),
            'language'              => $request->get('language'),
            'sound_mix'             => $request->get('sound_mix'),
            'box_office'            => $request->get('box_office'),
            'filming_location'      => $request->get('filming_location'),
            'country_origin'        => $request->get('country_origin'),
            'budget'                => $request->get('budget'),
            'is_active'             => $request->get('is_active') ? $request->get('is_active') : 'No',
            'modified_by'           => auth()->user()->id,
        ];

        if (!$id) {
            $attributes['create_by']  = auth()->user()->id;
        }

        if ($request->hasFile('potraitimage')) {
            // dd($request);
            $photo  = $request->file('potraitimage')->getClientOriginalName();
            $destination  = 'uploads/ptmovie';
            $request->file('potraitimage')->move($destination, $photo);
            $attributes['potraitimage']   = $destination . '/' . $photo;
        }
        if ($request->hasFile('landscapeimage')) {
            // dd($request);
            $photo  = $request->file('landscapeimage')->getClientOriginalName();
            $destination  = 'uploads/lsmovie';
            $request->file('landscapeimage')->move($destination, $photo);

            $attributes['landscapeimage']   = $destination . '/' . $photo;
        }
        try {
            if ($id) {
                $existing = Media::findOrFail($id);
                $sumbit =  Media::where('id', $id)->update($attributes);

                $entities = $this->mergeArrays(
                    $request->casts,
                    $request->producers,
                    $request->directors,
                    $request->writers,
                    $request->musicians,
                    $request->cinematographers,
                    $request->distributors,
                    $request->screenplay,
                    $request->role
                );
                //  dd($request);
                $existing->entity()->sync($entities);
                $existing->categories()->sync($request->category_id);
                $existing->tags()->sync($request->tag_id);
                $existing->relatedMedia()->sync($request->related_media);
                $abledata = [
                    'data' => $request,
                    'able_id' => $id,
                    'able_type' => Media::class,
                ];
                $this->seoPost($abledata);
            } else {

                $insert = Media::create($attributes);
                $abledata = [
                    'data' => $request,
                    'able_id' => $insert->id,

                    'able_type' => Media::class,
                ];

                $this->seoPost($abledata);
                $entities = $this->mergeArrays(
                    $request->casts, 
                    $request->producers,
                    $request->directors,
                    $request->writers,
                    $request->musicians,
                    $request->cinematographers,
                    $request->distributors,
                    $request->screenplay,
                    $request->role
                );
                //dd([$request->request, $entities]);
                $insert->entity()->sync($entities);
                $insert->categories()->sync($request->category_id);
                $insert->tags()->sync($request->tag_id);
                $insert->relatedMedia()->sync($request->related_media);
            }
            return redirect()->route('media.index')->with("Success", "Successfully save changed");
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->withErrors($ex->getMessage())
                ->with('myexcep', $ex->getMessage())->withInput();
        }
    }


    private function mergeArrays()
    {
        $args = func_get_args();
        $merged = $new = [];
        foreach ($args as $arr) {
            if (is_array($arr)) {
                foreach ($arr as $k => $v) {
                    // preserve the keys of previous array
                    if (is_array($v)) {
                        if (isset($v['is_new'])) {
                            if ($v['is_new']) {
                                unset($v['is_new']);
                                $new[] = $v;
                            } else {
                                unset($v['is_new']);
                                $merged[$k] = $v;
                            }
                        } else {
                            unset($v['is_new']);
                            $merged[$k] = $v;
                        }
                    }
                }
            }
        }
        // If new data is added
        if (!empty($new)) {
            foreach ($new as $na) {
                $merged[] = $na;
            }
        }
        return $merged;
    }
    // public function Seogenarate($request)
    // {

    //     $attributes = [
    //         'meta_title'        => $request->get('meta_title'),
    //         'meta_description'  => $request->get('meta_description'),
    //         'meta_keywords'     => $request->get('meta_keywords'),
    //         'canonical_tag'     => $request->get('canonical_tag'),
    //         'meta_type'         => $request->get('meta_type'),
    //         'meta_image'        => $request->get('meta_image'),
    //         'remarks'           => $request->get('remarks'),
    //         'sort_by'           => $request->get('sort_by'),
    //         'is_active'         => $request->get('is_active') ? $request->get('is_active') : 'No',
    //         'modified_by'       => auth('web')->user()->id,
    //     ];
    //     $id = $request->get('id');
    //     $seo_id = $request->get('seo_id');
    //     if (!$id) {
    //         // $attributes['created_by']  = auth('web')->user()->id;
    //     }

    //     //dump($id);
    //     if ($seo_id) {
    //         $existing = Seo::findOrFail($seo_id);
    //         $data =  Seo::where('id', $existing->id)->update($attributes);
    //         return $seo_id;
    //     } else {
    //         $data =  Seo::create($attributes);
    //         return $data->id;
    //     }

    //     return null;
    // }

    public function delete($id)
    {
        $movie = Media::findOrfail($id);
        if (!is_null($movie)) {
            //Delete Image
            if (File::exists($movie->potraitimage, $movie->landscapeimage)) {
                File::delete($movie->potraitimage, $movie->landscapeimage);
            }
            $movie->delete();
        }
        return redirect('/admin/media')->with("success", "Media deleted successfully.");
    }
}
