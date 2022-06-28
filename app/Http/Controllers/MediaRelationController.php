<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Media;
use App\Models\MediaRelation;

use App\Models\Role;
use Illuminate\Http\Request;

class MediaRelationController extends Controller
{
    public function index()
    {
        $people = MediaRelation::orderBy('id', 'desc')->get();
        return view('admin.pages.mediarelation.list', compact('people'));
    }

    public function add()
    {
        $movie = Media::orderBy('id', 'desc')->get();
        $people = Entity::orderBy('id', 'desc')->get();
        $role = Role::orderBy('id', 'desc')->get();
        return view('admin.pages.mediarelation.create')->with([
            'movie' => $movie,
            'people' => $people,
            'role' => $role
        ]);
    }
}
