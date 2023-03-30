# Pirate Weather PHP

PHP Library for the [Pirate Weather API](https://pirateweather.net/).

This is a fork of the [dmitry-ivanov/dark-sky-api](https://github.com/dmitry-ivanov/dark-sky-api) package.

## Usage

1. Install the package via Composer:

    ```shell script
    composer require matthewhallcom/pirate-weather-php
    ```

2. Use the `MatthewHallCom\PirateWeather\PirateWeather` class:

    ```php
    use MatthewHallCom\PirateWeather\PirateWeather;

    $forecast = (new PirateWeather('secret-key'))
        ->location(46.482, 30.723)
        ->forecast('daily');

    echo $forecast->daily()->summary();
    ```

## Time Machine Requests

Sometimes it might be useful to get weather for the specified date:

```php
$timeMachine = (new PirateWeather('secret-key'))
    ->location(46.482, 30.723)
    ->timeMachine('2020-01-01', 'daily');

echo $timeMachine->daily()->summary();
```

You can also get weather for multiple dates:

```php
$timeMachine = (new PirateWeather('secret-key'))
    ->location(46.482, 30.723)
    ->timeMachine(['2020-01-01', '2020-01-02', '2020-01-03'], 'daily');

echo $timeMachine['2020-01-02']->daily()->summary();
```

## Usage in Laravel

> If you're using Laravel <5.5, you have to register service provider and alias by yourself!

1. Publish the config:

    ```shell script
    php artisan vendor:publish --provider="MatthewHallCom\PirateWeather\Adapters\Laravel\PirateWeatherServiceProvider"
    ```

2. Set your secret key in the `.env` file:

    ```dotenv
    PIRATE_WEATHER_KEY="Your-Secret-Key"
    ```

3. Use the `PirateWeather` facade:

    ```php
    use PirateWeather;

    $forecast = PirateWeather::location(46.482, 30.723)
        ->forecast('daily');

    echo $forecast->daily()->summary();
    ```

## License

Pirate Weather PHP is open-sourced software licensed under the [MIT license](LICENSE.md).