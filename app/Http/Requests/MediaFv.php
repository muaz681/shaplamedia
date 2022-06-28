<?php

namespace App\Http\Requests;

use Illuminate\Foundation\FormRequest;
use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;
use Illuminate\Http\Request;

class MediaFv extends HttpFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name'              => 'required|max:150',
            'slug'              => 'required|max:191|unique:media,slug,' . $request->get('id'),
            'description'       => 'nullable',
            'category_id'       => 'nullable',
            'media_type'       => 'nullable',
            'link'              => 'nullable',
            'potraitimage'      => 'nullable',
            'landscapeimage'    => 'nullable',
            'movie-details'     => 'nullable',
            'ratings'           => 'nullable',
            'release_date'      => 'nullable',
            'ratings'           => 'nullable',
            'extra_css'         => 'nullable',
        ];
    }
}
