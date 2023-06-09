<?php

namespace MatthewHallCom\PirateWeather\Validation\Rule;

use MatthewHallCom\PirateWeather\Contracts\Validation\Rule;

class ExtendedBlocksRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function passes($value)
    {
        return is_null($value)
            || ($value === 'hourly');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given extended blocks are invalid.';
    }
}
