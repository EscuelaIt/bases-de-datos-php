<?php

namespace App\Validation;

use Respect\Validation\Factory;
use Respect\Validation\Validator as v;

class CustomerValidator {

  private $errors = [];
  private $data;

  public function __construct($data) {
    $this->data = $data;
    Factory::setDefaultInstance(
      (new Factory())
          ->withRuleNamespace('App\\Validation\\Rules')
          ->withExceptionNamespace('App\\Validation\\Exceptions')
    );
    $this->validate(); 
  }

  function validate() {
    $nameValidator = v::key('name', v::stringType()->length(1, 200));
    $emailValidator = v::key('email', v::email());
    $addressValidator = v::key('address', v::stringType()->length(1, 200));
    $countryIdValidator = v::key('country_id', v::digit()->ExistsCountry());

    if(! $nameValidator->validate($this->data)) {
      $this->errors['name'] = 'El nombre debe tener entre 1 y 200 caracteres';
    }
    if(! $emailValidator->validate($this->data)) {
      $this->errors['email'] = 'Debes indicar un email';
    }
    if(! $addressValidator->validate($this->data)) {
      $this->errors['address'] = 'La dirección debe tener entre 1 y 200 caracteres';
    }
    if(! $countryIdValidator->validate($this->data)) {
      $this->errors['country_id'] = 'Debes indicar un país';
    }
  }

  public function isValid() {
    return count($this->errors) == 0;
  }

  public function getErrors() {
    return $this->errors;
  }
}