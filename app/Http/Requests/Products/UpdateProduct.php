<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProduct extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isOwner();
    }

    public function rules()
    {
        return [
            'description' => 'required|min:5|string',
            'ean' => ['required', 'digits:13', Rule::unique('products')->ignore($this->route()->parameters['product']),],
        ];
    }
}
