<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

class TagValidator extends EntityValidator {
  public function validate() {
    $nameValidator = v::key('name', v::stringType()->length(3, 100));
    $descriptionValidator = v::key('description', v::stringType()->length(5, 250));
    if(! $nameValidator->validate($this->data)) {
      $this->errors['name'] = 'El nombre debe tener entre 3 y 100 caracteres';
    }
    if(! $descriptionValidator->validate($this->data)) {
      $this->errors['description'] = 'La descripción debe tener entre 5 y 250 caracteres';
    }
  }
}