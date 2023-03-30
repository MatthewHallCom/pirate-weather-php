<?php

namespace MatthewHallCom\PirateWeather\Http;

use MatthewHallCom\PirateWeather\Http\Request\QueryBuilder;
use MatthewHallCom\PirateWeather\Http\Request\UrlGenerator;
use MatthewHallCom\PirateWeather\Parameters;

class RequestFactory
{
    /**
     * The URL generator.
     *
     * @var \MatthewHallCom\PirateWeather\Http\Request\UrlGenerator
     */
    protected $url;

    /**
     * The query builder.
     *
     * @var \MatthewHallCom\PirateWeather\Http\Request\QueryBuilder
     */
    protected $query;

    /**
     * Create a new instance of the request factory.
     *
     * @param  \MatthewHallCom\PirateWeather\Http\Request\UrlGenerator|null  $url
     * @param  \MatthewHallCom\PirateWeather\Http\Request\QueryBuilder|null  $query
     * @return void
     */
    public function __construct(UrlGenerator $url = null, QueryBuilder $query = null)
    {
        $this->url = isset($url) ? $url : new UrlGenerator;
        $this->query = isset($query) ? $query : new QueryBuilder;
    }

    /**
     * Create the API request(s) by the given parameters.
     *
     * @param  \MatthewHallCom\PirateWeather\Parameters  $parameters
     * @return \MatthewHallCom\PirateWeather\Http\Request|\MatthewHallCom\PirateWeather\Http\Request[]
     */
    public function create(Parameters $parameters)
    {
        $url = $this->url->generate($parameters);
        $query = $this->query->build($parameters);

        if ($url instanceof Url) {
            return $this->createRequest($url, $query);
        }

        return array_map(function (Url $url) use ($query) {
            return $this->createRequest($url, $query);
        }, $url);
    }

    /**
     * Create a request by the given URL object and the query string.
     *
     * @param  \MatthewHallCom\PirateWeather\Http\Url  $url
     * @param  string  $query
     * @return \MatthewHallCom\PirateWeather\Http\Request
     */
    protected function createRequest(Url $url, $query)
    {
        $id = null;

        if ($urlMetadata = $url->metadata()) {
            $id = $urlMetadata->date();
        }

        return new Request($url->value(), $query, $id);
    }
}
