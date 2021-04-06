<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'search.required' => 'O campo de busca não pode ser vazio.',
        ];
    }
}
