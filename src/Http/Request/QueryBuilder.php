<?php

namespace MatthewHallCom\PirateWeather\Http\Request;

use MatthewHallCom\PirateWeather\Parameters;
use MatthewHallCom\PirateWeather\Parameters\Blocks;

class QueryBuilder
{
    /**
     * Build the request query string by the given parameters.
     *
     * @param  \MatthewHallCom\PirateWeather\Parameters  $parameters
     * @return string
     */
    public function build(Parameters $parameters)
    {
        $query = http_build_query([
            'exclude' => $this->composeExclude($parameters->getBlocks()),
            'extend' => $parameters->getExtendedBlocks(),
            'lang' => $parameters->getLanguage(),
            'units' => $parameters->getUnits(),
        ]);

        return urldecode($query);
    }

    /**
     * Compose the "exclude" query parameter by the given included blocks.
     *
     * @param  array|string|null  $included
     * @return string|null
     */
    protected function composeExclude($included)
    {
        if (is_null($included)) {
            return null;
        }

        $included = is_array($included) ? $included : [$included];
        $excluded = array_diff(Blocks::values(), $included);

        return $excluded ? implode(',', $excluded) : null;
    }
}
