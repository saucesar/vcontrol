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
            'emails' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'emails.required' => 'Selecione pelo menos 1 email',
            'emails.min' => 'Selecione pelo menos 1 email',
        ];
    }
}
