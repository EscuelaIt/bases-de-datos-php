<?php

namespace App\Validation;

use App\Log;
use Respect\Validation\Factory;
use Respect\Validation\Validator as v;

class StateValidator {

  private $data;

  public function __construct($data) {
    $this->data = $data;
    Factory::setDefaultInstance(
      (new Factory())
          ->withRuleNamespace('App\\Validation\\Rules')
          ->withExceptionNamespace('App\\Validation\\Exceptions')
    );
  }
  
  public function validate() {
    $nameValidator = v::key('name', v::stringType()->length(3, 100));
    $countryValidator = v::key('country_id', v::digit()->existsCountry());
    $errors = [];
    if(! $nameValidator->validate($this->data)) {
      $errors['name'] = 'El nombre debe tener entre 3 y 100 caracteres';
    }
    if(! $countryValidator->validate($this->data)) {
      $errors['country_id'] = 'Debes seleccionar un país válido';
    }
    return $errors;
  }
}