<?php

namespace MatthewHallCom\PirateWeather\Validation;

use MatthewHallCom\PirateWeather\Contracts\Validation\Rule;
use MatthewHallCom\PirateWeather\Parameters;
use MatthewHallCom\PirateWeather\Validation\Rule\ApiKeyRule;
use MatthewHallCom\PirateWeather\Validation\Rule\BlocksRule;
use MatthewHallCom\PirateWeather\Validation\Rule\DatesRule;
use MatthewHallCom\PirateWeather\Validation\Rule\ExtendedBlocksRule;
use MatthewHallCom\PirateWeather\Validation\Rule\LanguageRule;
use MatthewHallCom\PirateWeather\Validation\Rule\LatitudeRule;
use MatthewHallCom\PirateWeather\Validation\Rule\LongitudeRule;
use MatthewHallCom\PirateWeather\Validation\Rule\UnitsRule;
use InvalidArgumentException;

class Validator
{
    /**
     * Validate the given parameters.
     *
     * @param  \MatthewHallCom\PirateWeather\Parameters  $parameters
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function validate(Parameters $parameters)
    {
        foreach ($this->validations($parameters) as $validation) {
            $this->validateParameterValue($validation['rule'], $validation['value']);
        }
    }

    /**
     * Get the parameters' validations.
     *
     * @param  \MatthewHallCom\PirateWeather\Parameters  $parameters
     * @return array
     */
    protected function validations(Parameters $parameters)
    {
        return [
            ['rule' => new ApiKeyRule, 'value' => $parameters->getApiKey()],
            ['rule' => new LatitudeRule, 'value' => $parameters->getLatitude()],
            ['rule' => new LongitudeRule, 'value' => $parameters->getLongitude()],
            ['rule' => new UnitsRule, 'value' => $parameters->getUnits()],
            ['rule' => new LanguageRule, 'value' => $parameters->getLanguage()],
            ['rule' => new DatesRule, 'value' => $parameters->getDates()],
            ['rule' => new BlocksRule, 'value' => $parameters->getBlocks()],
            ['rule' => new ExtendedBlocksRule, 'value' => $parameters->getExtendedBlocks()],
        ];
    }

    /**
     * Validate the given parameter value using the given rule.
     *
     * @param  \MatthewHallCom\PirateWeather\Contracts\Validation\Rule  $rule
     * @param  mixed  $value
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    protected function validateParameterValue(Rule $rule, $value)
    {
        if (!$rule->passes($value)) {
            throw new InvalidArgumentException($rule->message());
        }
    }
}
