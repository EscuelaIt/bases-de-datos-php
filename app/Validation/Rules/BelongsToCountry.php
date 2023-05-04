<?php

namespace App\Validation\Rules;

use App\Log;
use App\Models\State;
use Respect\Validation\Rules\AbstractRule;

final class BelongsToCountry extends AbstractRule
{
    private $country_id;

    public function __construct($country_id) {
      $this->country_id = $country_id;
    }

    public function validate($state_id): bool
    {
        Log::log('probando validar la pertenencia del state:' . $state_id);
        $stateModel = new State();
        Log::log($stateModel->belongsToCountry($state_id, $this->country_id));
        return $stateModel->belongsToCountry($state_id, $this->country_id);
    }
}