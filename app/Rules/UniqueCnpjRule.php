<?php

namespace App\Rules;

use App\Models\Company;
use Illuminate\Contracts\Validation\Rule;

class UniqueCnpjRule implements Rule
{
    private ?int $ignoreId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?int $ignoreId = null)
    {
        $this->ignoreId = $ignoreId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cnpj = str_replace(['.', '-', '/'], '', $value);
        $query = Company::where('cnpj', $cnpj);

        if($this->ignoreId) {
            $query = $query->where('id', '<>', $this->ignoreId);
        }

        return !$query->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.unique');
    }
}
