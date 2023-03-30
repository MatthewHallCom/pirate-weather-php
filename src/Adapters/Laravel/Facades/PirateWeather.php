<?php

namespace MatthewHallCom\PirateWeather\Adapters\Laravel\Facades;

use MatthewHallCom\PirateWeather\Service;
use MatthewHallCom\PirateWeather\Weather\Forecast;
use MatthewHallCom\PirateWeather\Weather\TimeMachine;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Service location(float $latitude, float $longitude)
 * @method static Service units(string $units)
 * @method static Service language(string $language)
 * @method static Service extend(string $blocks = 'hourly')
 * @method static Forecast forecast(array|string|null $blocks = null)
 * @method static TimeMachine|TimeMachine[] timeMachine(array|string $dates, array|string|null $blocks = null)
 *
 * @see \MatthewHallCom\PirateWeather\Service
 */
class PirateWeather extends Facade
{
    /**
     * Get the facade accessor.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return Service::class;
    }
}
