<?php

namespace MatthewHallCom\PirateWeather\Weather;

class TimeMachine extends Forecast
{
    /**
     * A data point containing the weather conditions for the requested date.
     *
     * @see https://docs.pirateweather.net/en/latest/API/
     *
     * @return \MatthewHallCom\PirateWeather\Weather\DataPoint|null
     */
    public function daily()
    {
        $daily = parent::daily();

        if (is_null($daily)) {
            return null;
        }

        $points = $daily->data();

        return array_shift($points);
    }
}
