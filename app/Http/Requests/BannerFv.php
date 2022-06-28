<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BannerFv extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules(Request $request)
    {
        return [
            'media_id'                  => 'nullable',
            // 'slug'                  => 'required|max:191|unique:banners,slug,' . $request->get('id'),
            'description'           => 'nullable',
            'short_description'     => 'nullable',
            'year'                  => 'nullable',

            'age_limit'             => 'nullable',
            'image'                 => 'nullable',
            'cinebazurl'            => 'nullable',
            'trailler_button_url'   => 'nullable',
        ];
    }
}
