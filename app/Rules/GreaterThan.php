<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GreaterThan implements Rule
{
    private $compare;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($compare)
    {
        $this->compare = $compare;
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
        return intval($value) > intval($this->compare);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le niveau d\'attention ne peut pas être plus bas que le niveau critique !';
    }
}
