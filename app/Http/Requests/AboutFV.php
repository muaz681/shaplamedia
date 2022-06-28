<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AboutFv extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules(Request $request)
    {
        return [
            'about_description'     => 'required',
            // 'slug'                  => 'required|max:191|unique:banners,slug,' . $request->get('id'),
            'message_chairman'      => 'nullable',
            'mission'               => 'nullable',
            'vision'                => 'nullable',
        ];
    }
}
