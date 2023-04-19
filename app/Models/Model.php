<?php

namespace App\Models;

class Model {

  protected function getConnection() {
    return Connection::getInstance()->getConnection();  
  }

}