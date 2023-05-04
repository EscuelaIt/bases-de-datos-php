<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

class CustomerValidator extends EntityValidator {

  function validate() {
    $nameValidator = v::key('name', v::stringType()->length(1, 200));
    $emailValidator = v::key('email', v::email());
    $addressValidator = v::key('address', v::stringType()->length(1, 200));
    $countryIdValidator = v::key('country_id', v::digit()->ExistsCountry());
    $stateValidator = v::key('state_id', v::digit()->existsState());

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
    if(! $stateValidator->validate($this->data)) {
      $this->errors['state_id'] = 'Debes seleccionar una provincia válida';
    } 
    if(!isset($this->errors['country_id']) && !isset($this->errors['state_id'])) {
      //$stateValidator = v::belongsToCountry($this->data["country_id"]);
      $stateValidator = v::belongsToCountry($this->data["country_id"]);
      if(! $stateValidator->validate($this->data["state_id"])) {
        $this->errors['state_id'] = 'La provincia no pertenece al país';
      }
    }
  }
}