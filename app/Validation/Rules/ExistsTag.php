<?php

namespace App\Validation\Rules;

use App\Log;
use App\Models\Tag;
use Respect\Validation\Rules\AbstractRule;

final class ExistsTag extends AbstractRule
{
    public function validate($tag_id): bool
    {
        $tagModel = new Tag();
        return $tagModel->exists($tag_id);
    }
}