<?php

namespace App\Rules;

use App\Models\Email;
use Illuminate\Contracts\Validation\Rule;

class UniqueEmailRule implements Rule
{
    private int $companyId;
    private ?int $ignoreId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $companyId, ?int $ignoreId = null)
    {
        $this->companyId = $companyId;
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
        $query = Email::where('company_id', $this->companyId)
                      ->where('email', $value);

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
