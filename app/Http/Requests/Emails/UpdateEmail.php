<?php

namespace App\Http\Requests\Emails;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmail extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isOwner();
    }

    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => ['required', 'email:rfc', Rule::unique('emails')->ignore($this->route()->parameters['email'])],
        ];
    }
}
