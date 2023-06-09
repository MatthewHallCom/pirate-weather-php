<?php

namespace MatthewHallCom\PirateWeather\Parameters;

class Blocks
{
    /**
     * Get the supported blocks.
     *
     * @return array
     */
    public static function values()
    {
        return ['currently', 'minutely', 'hourly', 'daily', 'alerts', 'flags'];
    }
}
