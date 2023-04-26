<?php

namespace App\Validation\Rules;

use App\Log;
use App\Models\State;
use App\Models\Customer;
use Respect\Validation\Rules\AbstractRule;

final class IsAssociatedWithTag extends AbstractRule
{
    private $tagId;

    public function __construct($tagId) {
      $this->tagId = $tagId;
    }

    public function validate($customerId): bool
    {
        Log::log("probando validar la pertenencia del tag: {$this->tagId} con el cliente: {$customerId}");
        $customerModel = new Customer();
        return ! $customerModel->hasTagAssociated($customerId, $this->tagId);
    }
}
