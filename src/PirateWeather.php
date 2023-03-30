<?php

namespace MatthewHallCom\PirateWeather;

class PirateWeather extends Service
{
    /**
     * Create a new instance of the Pirate Weather API.
     *
     * @param  string  $key
     * @return void
     */
    public function __construct($key)
    {
        parent::__construct($key);
    }
}
