<?php

namespace MatthewHallCom\PirateWeather\Adapters\Laravel;

use MatthewHallCom\PirateWeather\Parameters;
use MatthewHallCom\PirateWeather\Service;
use Illuminate\Support\ServiceProvider;

class PirateWeatherServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/pirate-weather.php', 'pirate-weather');

        $this->registerApiService();
    }

    /**
     * Register the API service in the container.
     *
     * @return void
     */
    protected function registerApiService()
    {
        $this->app->instance(
            Service::class,
            new Service(config('pirate-weather.key'), $this->apiServiceParameters())
        );
    }

    /**
     * Compose the API service parameters.
     *
     * @return \MatthewHallCom\PirateWeather\Parameters
     */
    protected function apiServiceParameters()
    {
        $parameters = new Parameters;

        $parameters->setUnits(config('pirate-weather.units'));
        $parameters->setLanguage(config('pirate-weather.language'));
        $parameters->setExtendedBlocks(config('pirate-weather.extend'));

        return $parameters;
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/config/pirate-weather.php' => config_path('pirate-weather.php')]);
    }
}
