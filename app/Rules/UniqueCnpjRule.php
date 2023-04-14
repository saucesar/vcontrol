<?php

namespace App\Rules;

use App\Models\Company;
use Illuminate\Contracts\Validation\Rule;

class UniqueCnpjRule implements Rule
{
    private ?int $ignore_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(?int $ignore_id = null)
    {
        $this->ignore_id = $ignore_id;
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

        if($this->ignore_id) {
            $query = $query->where('id', '<>', $this->ignore_id);
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
