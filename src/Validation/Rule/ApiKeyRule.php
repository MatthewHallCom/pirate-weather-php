<?php

namespace MatthewHallCom\PirateWeather\Validation\Rule;

use MatthewHallCom\PirateWeather\Contracts\Validation\Rule;

class ApiKeyRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function passes($value)
    {
        return is_string($value)
            && !empty($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given API key is invalid.';
    }
}
