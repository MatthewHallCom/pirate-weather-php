<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Secret Key
    |--------------------------------------------------------------------------
    |
    | The secret key which grants you access to the Pirate Weather API.
    | Keep it secret, do not embed it to the response body.
    |
    | @link https://pirateweather.net
    |
    */

    'key' => env('PIRATE_WEATHER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    | Specify the language for the human-readable text summaries here.
    | Check the documentation for the list of the supported values.
    | Null means the usage of the default Pirate Weather API settings.
    |
    | @see https://docs.pirateweather.net/en/latest/API/
    |
    */

    'language' => null,

    /*
    |--------------------------------------------------------------------------
    | Units
    |--------------------------------------------------------------------------
    |
    | Here you may specify the unit system for the weather conditions.
    | Check the documentation for the list of the supported values.
    | Null means the usage of the default Pirate Weather API settings.
    |
    | @see https://docs.pirateweather.net/en/latest/API/
    |
    */

    'units' => null,

    /*
    |--------------------------------------------------------------------------
    | Extend
    |--------------------------------------------------------------------------
    |
    | Here specify the weather blocks, which should have the extended data.
    | For now, it affects only the forecast requests, the hourly blocks.
    | When present, the block extends from the 48 hours to 168 hours.
    |
    | @see https://docs.pirateweather.net/en/latest/API/
    |
    */

    'extend' => null,

];
