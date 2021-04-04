<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isOwner();
    }

    public function rules()
    {
        return [
            'name' => 'required|min:5|unique:categories',
        ];
    }
}
