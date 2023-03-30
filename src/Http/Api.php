<?php

namespace MatthewHallCom\PirateWeather\Http;

use MatthewHallCom\PirateWeather\Contracts\Http\Client;
use MatthewHallCom\PirateWeather\Http\Client\GuzzleClient;
use MatthewHallCom\PirateWeather\Parameters;
use MatthewHallCom\PirateWeather\Weather\Forecast;
use MatthewHallCom\PirateWeather\Weather\TimeMachine;
use Psr\Http\Message\ResponseInterface;

class Api
{
    /**
     * The HTTP client.
     *
     * @var \MatthewHallCom\PirateWeather\Contracts\Http\Client
     */
    protected $client;

    /**
     * The request factory.
     *
     * @var \MatthewHallCom\PirateWeather\Http\RequestFactory
     */
    protected $factory;

    /**
     * Create a new instance of the API.
     *
     * @param  \MatthewHallCom\PirateWeather\Contracts\Http\Client|null  $client
     * @param  \MatthewHallCom\PirateWeather\Http\RequestFactory|null  $factory
     * @return void
     */
    public function __construct(Client $client = null, RequestFactory $factory = null)
    {
        $this->client = isset($client) ? $client : new GuzzleClient;
        $this->factory = isset($factory) ? $factory : new RequestFactory;
    }

    /**
     * Make the forecast request.
     *
     * @param  \MatthewHallCom\PirateWeather\Parameters  $parameters
     * @return \MatthewHallCom\PirateWeather\Weather\Forecast
     *
     * @throws \Exception on HTTP error
     * @throws \Throwable on HTTP error in PHP >=7
     */
    public function forecast(Parameters $parameters)
    {
        $request = $this->factory->create($parameters);

        $response = $this->client->gzip()->request($request);

        return $this->composeForecastResponse($response);
    }

    /**
     * Make the time machine request(s).
     *
     * @param  \MatthewHallCom\PirateWeather\Parameters  $parameters
     * @return \MatthewHallCom\PirateWeather\Weather\TimeMachine|\MatthewHallCom\PirateWeather\Weather\TimeMachine[]
     *
     * @throws \Exception on HTTP error
     * @throws \Throwable on HTTP error in PHP >=7
     */
    public function timeMachine(Parameters $parameters)
    {
        $request = $this->factory->create($parameters);

        if ($request instanceof Request) {
            $response = $this->client->gzip()->request($request);
            return $this->composeTimeMachineResponse($response);
        }

        $responses = $this->client->gzip()->concurrentRequests($request);

        return array_map(function (ResponseInterface $response) {
            return $this->composeTimeMachineResponse($response);
        }, $responses);
    }

    /**
     * Compose the forecast response.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     * @return \MatthewHallCom\PirateWeather\Weather\Forecast
     *
     * @throws \InvalidArgumentException
     */
    protected function composeForecastResponse(ResponseInterface $response)
    {
        $data = \MatthewHallCom\PirateWeather\json_decode($response->getBody(), true);

        return new Forecast($data, $response->getHeaders());
    }

    /**
     * Compose the time machine response.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     * @return \MatthewHallCom\PirateWeather\Weather\TimeMachine
     *
     * @throws \InvalidArgumentException
     */
    protected function composeTimeMachineResponse(ResponseInterface $response)
    {
        $data = \MatthewHallCom\PirateWeather\json_decode($response->getBody(), true);

        return new TimeMachine($data, $response->getHeaders());
    }
}
