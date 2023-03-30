<?php

namespace MatthewHallCom\PirateWeather;

use MatthewHallCom\PirateWeather\Http\Api;
use MatthewHallCom\PirateWeather\Validation\Validator;

class Service
{
    /**
     * The parameters.
     *
     * @var \MatthewHallCom\PirateWeather\Parameters
     */
    protected $parameters;

    /**
     * The validator.
     *
     * @var \MatthewHallCom\PirateWeather\Validation\Validator
     */
    protected $validator;

    /**
     * The HTTP API.
     *
     * @var \MatthewHallCom\PirateWeather\Http\Api
     */
    protected $api;

    /**
     * Create a new instance of the Pirate Weather PHP service.
     *
     * @param  string  $apiKey
     * @param  \MatthewHallCom\PirateWeather\Parameters|null  $parameters
     * @param  \MatthewHallCom\PirateWeather\Validation\Validator|null  $validator
     * @param  \MatthewHallCom\PirateWeather\Http\Api|null  $api
     * @return void
     */
    public function __construct($apiKey, Parameters $parameters = null, Validator $validator = null, Api $api = null)
    {
        $this->parameters = !is_null($parameters) ? $parameters : new Parameters;
        $this->validator = !is_null($validator) ? $validator : new Validator;
        $this->api = !is_null($api) ? $api : new Api;

        $this->parameters->setApiKey($apiKey);
    }

    /**
     * Get the parameters.
     *
     * @return \MatthewHallCom\PirateWeather\Parameters
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set the location.
     *
     * @see https://docs.pirateweather.net/en/latest/API/
     *
     * @param  float  $latitude
     * @param  float  $longitude
     * @return $this
     */
    public function location($latitude, $longitude)
    {
        $this->parameters->setLatitude($latitude);
        $this->parameters->setLongitude($longitude);

        return $this;
    }

    /**
     * Set the units.
     *
     * @see https://docs.pirateweather.net/en/latest/API/
     *
     * @param  string  $units
     * @return $this
     */
    public function units($units)
    {
        $this->parameters->setUnits($units);

        return $this;
    }

    /**
     * Set the language.
     *
     * @see https://docs.pirateweather.net/en/latest/API/
     *
     * @param  string  $language
     * @return $this
     */
    public function language($language)
    {
        $this->parameters->setLanguage($language);

        return $this;
    }

    /**
     * Set the extended blocks.
     *
     * @see https://docs.pirateweather.net/en/latest/API/
     *
     * @param  string  $blocks
     * @return $this
     */
    public function extend($blocks = 'hourly')
    {
        $this->parameters->setExtendedBlocks($blocks);

        return $this;
    }

    /**
     * Get the weather forecast.
     *
     * Possible values: "currently", "minutely", "hourly", "daily", "alerts", "flags".
     * @see https://docs.pirateweather.net/en/latest/API/
     *
     * @param  array|string|null  $blocks
     * @return \MatthewHallCom\PirateWeather\Weather\Forecast
     *
     * @throws \Exception on HTTP error
     * @throws \Throwable on HTTP error in PHP >=7
     */
    public function forecast($blocks = null)
    {
        $this->parameters->setBlocks($blocks);

        $this->validator->validate($this->parameters);

        return $this->api->forecast($this->parameters);
    }

    /**
     * Get the observed weather for the given date(s).
     *
     * Possible values: "currently", "minutely", "hourly", "daily", "alerts", "flags".
     * @see https://docs.pirateweather.net/en/latest/API/
     *
     * @param  array|string  $dates
     * @param  array|string|null  $blocks
     * @return \MatthewHallCom\PirateWeather\Weather\TimeMachine|\MatthewHallCom\PirateWeather\Weather\TimeMachine[]
     *
     * @throws \Exception on HTTP error
     * @throws \Throwable on HTTP error in PHP >=7
     */
    public function timeMachine($dates, $blocks = null)
    {
        $this->parameters->setDates($dates);
        $this->parameters->setBlocks($blocks);

        $this->validator->validate($this->parameters);

        return $this->api->timeMachine($this->parameters);
    }
}
