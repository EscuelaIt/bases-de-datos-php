<?php

namespace App\Validation;

use Respect\Validation\Factory;

abstract class EntityValidator {

  protected $errors = [];
  protected $data;

  public function __construct($data) {
    $this->data = $data;
    Factory::setDefaultInstance(
      (new Factory())
          ->withRuleNamespace('App\\Validation\\Rules')
          ->withExceptionNamespace('App\\Validation\\Exceptions')
    );
    $this->validate(); 
  }

  abstract function validate();

  public function isValid() {
    return count($this->errors) == 0;
  }

  public function getErrors() {
    return $this->errors;
  }
}