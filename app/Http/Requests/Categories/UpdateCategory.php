<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategory extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isOwner();
    }

    public function rules()
    {
        return [
            'name' => ['required','min:5', Rule::unique('categories')->ignore($this->route()->parameters['category'])],
            'emails' => 'required|array|min:1',
        ];
    }
}
