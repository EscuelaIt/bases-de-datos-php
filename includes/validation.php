<?php
use Respect\Validation\Factory;
use Respect\Validation\Validator as v;

function validateCustomer($data) {
  Factory::setDefaultInstance(
    (new Factory())
        ->withRuleNamespace('App\\Validation\\Rules')
        ->withExceptionNamespace('App\\Validation\\Exceptions')
  );
  $nameValidator = v::key('name', v::stringType()->length(1, 200));
  $emailValidator = v::key('email', v::email());
  $addressValidator = v::key('address', v::stringType()->length(1, 200));
  $countryIdValidator = v::key('country_id', v::digit()->ExistsCountry());
  $errors = [];
  if(! $nameValidator->validate($data)) {
    $errors['name'] = 'El nombre debe tener entre 1 y 200 caracteres';
  }
  if(! $emailValidator->validate($data)) {
    $errors['email'] = 'Debes indicar un email';
  }
  if(! $addressValidator->validate($data)) {
    $errors['address'] = 'La dirección debe tener entre 1 y 200 caracteres';
  }
  if(! $countryIdValidator->validate($data)) {
    $errors['country_id'] = 'Debes indicar un país';
  }
  return $errors;
}