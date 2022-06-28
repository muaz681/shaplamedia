<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryFv extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name'              => 'required|max:150',
            // 'slug'              => 'required|max:191|unique:people,slug,' . $request->get('id'),
            'description'       => 'nullable',
        ];
    }
}
