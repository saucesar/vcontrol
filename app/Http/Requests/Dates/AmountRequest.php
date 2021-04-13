<?php

namespace App\Http\Requests\Dates;

use Illuminate\Foundation\Http\FormRequest;

class AmountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount'=> 'required|numeric|min:1',
            'reason_id'=> 'required|exists:reasons,id',
        ];
    }
}
