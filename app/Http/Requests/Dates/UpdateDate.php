<?php

namespace App\Http\Requests\Dates;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDate extends FormRequest
{
    public function authorize()
    {
        $user = auth()->user();
        return $user->status == 'granted' || $user->isOwner();
    }

    public function rules()
    {
        return [
            'date' => 'required|after:today|date',
            'amount' => 'required|numeric|min:1',
            'lote' => 'nullable',
            'product_id' => 'required|exists:products,id',
            'reason_id' => 'required|exists:reasons,id',
        ];
    }
}
