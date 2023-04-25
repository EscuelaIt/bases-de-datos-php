<?php

namespace App\Validation\Rules;

use App\Log;
use App\Models\Country;
use Respect\Validation\Rules\AbstractRule;

final class ExistsCountry extends AbstractRule
{
    public function validate($country_id): bool
    {
        Log::log('probando validar country:' . $country_id);
        $countryModel = new Country();
        Log::log($countryModel->exists($country_id));
        return $countryModel->exists($country_id);
    }
}