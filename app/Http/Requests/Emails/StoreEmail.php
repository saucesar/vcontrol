<?php

namespace App\Http\Requests\Emails;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmail extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isOwner();
    }

    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email:rfc|unique:emails',
        ];
    }
}
