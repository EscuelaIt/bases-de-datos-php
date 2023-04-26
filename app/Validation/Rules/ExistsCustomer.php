<?php

namespace App\Validation\Rules;

use App\Log;
use App\Models\Customer;
use Respect\Validation\Rules\AbstractRule;

final class ExistsCustomer extends AbstractRule
{
    public function validate($customer_id): bool
    {
        Log::log('vamos a validar que existe el cliente' . $customer_id);
        $customerModel = new Customer();
        return $customerModel->exists($customer_id);
    }
}