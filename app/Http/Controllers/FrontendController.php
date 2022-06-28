<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Media;
use App\Models\Tag;
use App\Models\Seo;
use App\Traits\TSeo;
use App\Models\MediaCategory;
use App\Models\MediaEntity;
use App\Models\MediaImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{

    public function index()
    {
        $seo = new Seo();
        $seo->meta_title = 'Shapla Media - Film Producer, Distributor and Licensor';
        $seo->meta_description = 'Shapla Media is Banglades\'s biggest film producing company';
        $seo->meta_keywords = 'Film, producer, distributor, shapla media';
        $seo->canonical_tag = 'https://shaplamedia.com';
        $seo->meta_type = 'website';
        $seo->meta_image = 'https://shaplamedia.com/img/shapla/logo.png';

        $slider = Banner::orderBy('id', 'desc')->get();
        // $d = Banner::findOrFail();
        $new    = Media::orderBy('id', 'desc')->get();
        $media  = Media::orderBy('id', 'desc')->get();
        $drama  =Media::orderBy('id', 'desc')->where('media_type', 'drama')->get();
        // $mdata['trendy'] = Media::where('media_type', 'trending')->get();
        $upcoming = Tag::where('name', 'Upcoming')->first();
        $trending = Tag::where('name', 'Trending')->first();
        $song = Tag::where('name', 'Song')->first();

        // return view('frontend.pages.movies')->with($mdata);
        return view('frontend.pages.home')->with([
            'seo' => $seo,
            'slider' => $slider,
            'new' => $new,
            'media' => $media,
            'upcoming' => $upcoming,
            'trending' => $trending,
            'song' => $song,
            'drama' => $drama,
        ]);
    }


    public function team()
    {
    
        // $info = Entity::all($id);
        $entity = Entity::orderBy('id', 'asc')->get();
        // dd($info->roles);
        return view('frontend.pages.team')->with([
            //'entity' => $entity,
            'entity' => $entity
        ]);
    }
    

    public function songDetailPage($slug)
    {

        if (strlen($slug) == 0) {
            return redirect()->route('frontend.home');
        }
        // $info__ = Media::findOrFail($id);
        $media = Media::where(['slug' => $slug])->firstOrFail();
        $mediaEntity = new MediaEntity;
        //$mediaEntity->getMediaEntityByRole($id, 2);
        $mediaimage = MediaImage::where('media_id', $media->id)->orderBy('id', 'desc')->first();
        //$query = DB::select('select image from media_images where movies.id =mediaimage.media_id');

        if (empty($media)) {
            return redirect()->route('frontend.home');
        }


        $data['mdata']          = $media;
        $data['seo']            = $media->seo;
        $data['mediaimage']     = $mediaimage;
        // $data['link']           = $link;
        $data['images']         = json_decode($mediaimage ? $mediaimage->image : null, true);
        $data['directors']      = $mediaEntity->getMediaEntityByRole($media->id, 2);
        $data['producers']      = $mediaEntity->getMediaEntityByRole($media->id, 4);
        $data['casts']          = $mediaEntity->getMediaEntityByRole($media->id, 1);
        $data['writers']        = $mediaEntity->getMediaEntityByRole($media->id, 5);
        $data['musicians']      = $mediaEntity->getMediaEntityByRole($media->id, 6);
        $data['distributors']   = $mediaEntity->getMediaEntityByRole($media->id, 8);
        $data['screenplay']     = $mediaEntity->getMediaEntityByRole($media->id, 12);
        $data['roles']          = $mediaEntity->getRoles($media->id);
        //dd($mediaimage);


        $info = $media;
        if(!$info->seo->canonical_tag)  $info->seo->canonical_tag = '/song/'.$info->slug;
        if(!$info->seo->meta_title)  $info->seo->meta_title = $info->name;
        $info->seo->meta_image = ($info->seo->meta_image)? $info->seo->meta_image: (($info->potraitimage) ? url($info->potraitimage) : url($info->landscapeimage));
        if(!$info->seo->meta_description)  $info->seo->meta_description = \Illuminate\Support\Str::limit($info->description, 160);
        $info->seo->og_type = 'music.song';

        return view('frontend.pages.song')->with([
            'seo' => $info->seo,
            'data' => $data,
            'mdata' => $media,
        ]);


        // return view('frontend.pages.song');
    }
    public function castandcrew($slug)
    {

        $media =  Media::where(['slug' => $slug])->firstOrFail();
        $data['entities']    = Entity::all();
        

        $data['new']    = Media::orderBy('id', 'desc')->take(5)->get();
        $data['media']      = $media;
        $data['related_m']  = Media::leftjoin('media', 'media_category.category_id');
        $data['querys']      = MediaCategory::where('id', $media->id)->get();


        // $query->media; 
        // $data['related_m'] = DB::table('media', 'category')->get();
        return view('frontend.pages.full_cast_crew', $data);
    }



    public function media()
    {
        $mdata['slider'] = Banner::orderBy('id', 'desc')->get();
        $mdata['new']    = Media::orderBy('id', 'desc')->get();
        $mdata['theaters'] = Tag::where('name', 'Theaters')->first();
        // $mdata['media']  = Media::where('media_type', 'song')->get();
        $mdata['song'] = Tag::where('name', 'Song')->first();
        // $mdata['md'] = Media::find(1)->media;
        return view('frontend.pages.movies')->with($mdata);
    }

    public function allmovie()
    {
        $mdata['slider'] = Banner::orderBy('id', 'desc')->get();
        $mdata['trendy'] = Media::orderBy('id', 'desc')->get();
        $mdata['new']    = Media::orderBy('id', 'desc')->get();
        $mdata['media']  = Media::orderBy('id', 'desc')->first();
        
        return view('frontend.pages.allmovies')->with($mdata);
    
    }
    public function songspage()
    {
      
        $mdata['song'] = Tag::where('name', 'Song')->first();
        return view('frontend.pages.songspages')->with($mdata);


    }

    public function view($slug)
    {
        if (strlen($slug) == 0) {
            return redirect()->route('frontend.home');
        }

        
        $media = Media::where(['slug' => $slug])->firstOrFail();

        $song = Media::where(['media_type' => 'song', 'parent_id'=> $media->id])->get();

        $mediaEntity = new MediaEntity;
        
        //$mediaEntity->getMediaEntityByRole($id, 2);
        $mediaimage = MediaImage::where('media_id', $media->id)->orderBy('id', 'desc')->first();
        
        // $query = DB::select('select image from media_images where movies.id =mediaimage.media_id');
// dd($mediaEntity->getMediaEntityByRole($media->id, 4));

        if (empty($media)) {
            return redirect()->route('frontend.home');
        }
        $data['mdata']          = $media;
        $data['song']           = $song;
        $data['seo']            = $media->seo;
        $data['mediaimage']     = $mediaimage;
        $data['images']         = json_decode($mediaimage ? $mediaimage->image : null, true);
        $data['directors']      = $mediaEntity->getMediaEntityByRole($media->id, 2);
        $data['producers']      = $mediaEntity->getMediaEntityByRole($media->id, 4);
        $data['casts']          = $mediaEntity->getMediaEntityByRole($media->id, 1);
        $data['writers']        = $mediaEntity->getMediaEntityByRole($media->id, 5);
        $data['musicians']      = $mediaEntity->getMediaEntityByRole($media->id, 6);
        $data['distributors']   = $mediaEntity->getMediaEntityByRole($media->id, 8);
        $data['screenplay']     = $mediaEntity->getMediaEntityByRole($media->id, 10);
        $data['roles']          = $mediaEntity->getRoles($media->id);

        
        $info = $media;
        if(!$info->seo->canonical_tag)  $info->seo->canonical_tag = '/media/'.$info->slug;
        if(!$info->seo->meta_title)  $info->seo->meta_title = $info->name;
        $info->seo->meta_image = ($info->seo->meta_image)? $info->seo->meta_image: (($info->potraitimage) ? url($info->potraitimage) : url($info->landscapeimage));
        if(!$info->seo->meta_description)  $info->seo->meta_description = \Illuminate\Support\Str::limit($info->description, 160);
        $info->seo->og_type = 'artical';

        // dd($data['roles'] );
        return view('frontend.pages.detail')->with([
            'data' => $data,
            'mdata' => $media,
            'seo' => $media->seo,
            'song' => $song,
            'mediaimage' => $mediaimage
        ]);
    }
    
    public function about()
    {
        // $banner['slider'] = Banner::orderBy('id', 'desc')->get();
        $about['about'] = About::orderBy('id', 'desc')->first();
        return view('frontend.pages.about')->with($about);
    }
    public function contact()
    {
        // $banner['slider'] = Banner::orderBy('id', 'desc')->get();
        return view('frontend.pages.contact');
    }

    public function profiles($slug)
    {
        $id = false;
        if(filter_var($slug, FILTER_VALIDATE_INT)) {
            $info = Entity::where('id', $slug)->firstOrFail();
            $id = true;
        } else
            $info = Entity::where('slug', $slug)->firstOrFail();
            if(!$info->seo->canonical_tag)  $info->seo->canonical_tag = '/profile/'.$info->slug;
            if(!$info->seo->meta_title)  $info->seo->meta_title = $info->name;
            $info->seo->meta_image = ($info->seo->meta_image)? $info->seo->meta_image: (($info->image) ? url($info->image) :null);
            if(!$info->seo->meta_description)  $info->seo->meta_description = \Illuminate\Support\Str::limit($info->description, 160);

        //$entity = Entity::orderBy('id', 'desc')->get();
        //    dd($info->seo);
        return view('frontend.pages.profiles')->with([
            'seo' => $info->seo,
            'info' => $info,
            'id' => $id
        ]);
    }
}
