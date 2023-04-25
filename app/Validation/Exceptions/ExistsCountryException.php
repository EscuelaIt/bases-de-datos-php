<?php 

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

final class ExistsCountryException extends ValidationException
{
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Ese país no existe.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Ese país ya está incluido.',
        ],
    ];
}