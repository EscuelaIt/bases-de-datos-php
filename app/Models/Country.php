<?php

namespace App\Models;

class Country extends Model {

  public function __construct() {
    $this->table = 'countries';
  }

  public function insert($data) {
    $mysqli = $this->getConnection();
    $ssql = "INSERT INTO countries (name) VALUES (:name)";
    $statement = $mysqli->prepare($ssql);
    return $statement->execute([
      ':name' => $data["name"],
    ]);
  }
}