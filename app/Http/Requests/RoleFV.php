<?php

namespace App\Http\Requests;

use Illuminate\Foundation\FormRequest;
use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;
use Illuminate\Http\Request;

class RoleFv extends HttpFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'title'              => 'required|max:150',
            // 'slug'              => 'required|max:191|unique:people,slug,' . $request->get('id'),
            // 'description'       => 'nullable',
        ];
    }
}
