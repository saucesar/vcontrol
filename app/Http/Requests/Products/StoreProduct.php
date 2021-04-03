<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isOwner();
    }

    public function rules()
    {
        return [
            'description' => 'required|min:5|string',
            'ean' => 'required|digits:13|unique:products',
        ];
    }
}
