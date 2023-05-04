<?php

namespace App\Validation;

use App\Log;
use Respect\Validation\Factory;
use Respect\Validation\Validator as v;

class CountryValidator {

  private $data;

  public function __construct($data) {
    $this->data = $data;
  }
  public function validate() {
    $nameValidator = v::key('name', v::stringType()->length(3, 100));
    $errors = [];
    if(! $nameValidator->validate($this->data)) {
      $errors['name'] = 'El nombre debe tener entre 3 y 100 caracteres';
    }
    return $errors;
  }
}