<?php

namespace App\Validation;

use Respect\Validation\Validator as v;

class CustomerTagValidator extends EntityValidator {

  private $validateExistence;

  public function __construct($data, $validateExistence = true) {
    $this->validateExistence = $validateExistence;
    parent::__construct($data);
  }

  public function validate() {
    $tagValidator = v::key('tag_id', v::digit()->existsTag());
    $customerValidator = v::key('customer_id', v::digit()->existsCustomer());

    if(! $tagValidator->validate($this->data)) {
      $this->errors['tag'] = 'El tag no es válido';
    }
    if(! $customerValidator->validate($this->data)) {
      $this->errors['tag'] = 'El cliente no es válido';
    }
    if($this->validateExistence && count($this->errors) == 0) {
      $customerTagValidator = v::isAssociatedWithTag($this->data['tag_id']);
      if(! $customerTagValidator->validate($this->data['customer_id'])) {
        $this->errors['customer_tag'] = 'Ya están relacionados';
      }
    }
  }
}