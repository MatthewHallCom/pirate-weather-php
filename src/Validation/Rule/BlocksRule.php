<?php

namespace MatthewHallCom\PirateWeather\Validation\Rule;

use MatthewHallCom\PirateWeather\Contracts\Validation\Rule;
use MatthewHallCom\PirateWeather\Parameters\Blocks;

class BlocksRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function passes($value)
    {
        if (is_null($value)) {
            return true;
        }

        if (is_string($value)) {
            return $this->isValidString($value);
        }

        if (is_array($value)) {
            return $this->isValidArray($value);
        }

        return false;
    }

    /**
     * Check if a given string value is valid.
     *
     * @param  string  $value
     * @return bool
     */
    protected function isValidString($value)
    {
        return in_array($value, Blocks::values());
    }

    /**
     * Check if the given values array is valid.
     *
     * @param  array  $values
     * @return bool
     */
    protected function isValidArray(array $values)
    {
        if (empty($values)) {
            return false;
        }

        foreach ($values as $value) {
            if (!is_string($value) || !$this->isValidString($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given blocks are invalid.';
    }
}
