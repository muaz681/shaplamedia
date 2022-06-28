<?php

namespace App\Http\Requests;

use Illuminate\Foundation\FormRequest;
use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;
use Illuminate\Http\Request;

class RolesFv extends HttpFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name'              => 'required|max:150',
            'title'              => 'required|max:150',
            'description'       => 'nullable',
        ];
    }
}
