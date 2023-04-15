<?php

namespace App\Http\Requests\Emails;

use App\Helpers\UserSession;
use App\Rules\UniqueEmailRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmail extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->isOwner();
    }

    public function rules()
    {
        $company = UserSession::getCompany();
        return [
            'name' => ['required', 'min:5'],
            'email' => ['required', 'email:rfc', new UniqueEmailRule($company->id)],
        ];
    }
}
