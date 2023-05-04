<?php

namespace App\Validation\Rules;

use App\Log;
use App\Models\State;
use Respect\Validation\Rules\AbstractRule;

final class ExistsState extends AbstractRule
{
    public function validate($state_id): bool
    {
        Log::log('probando validar state:' . $state_id);
        $stateModel = new State();
        Log::log($stateModel->exists($state_id));
        return $stateModel->exists($state_id);
    }
}