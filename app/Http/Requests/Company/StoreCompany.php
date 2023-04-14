<?php

namespace App\Http\Requests\Company;

use App\Rules\UniqueCnpjRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cnpj' => ['required', new UniqueCnpjRule(), 'between:14,18'],
            'name' => ['required', 'min:3']
        ];
    }
}
