<?php

namespace App\Models;

use App\Log;

class State extends Model {
  
  public function __construct() {
    $this->table = 'states';
  }

  public function getCountryStates($country_id) {
    $pdo = $this->getConnection();
    $statement = $pdo->prepare("SELECT * FROM states where country_id = :country_id");
    $statement->execute([
      ':country_id' => $country_id,
    ]);
    return $statement->fetchAll();
  }

  public function insert($data) {
    $pdo = $this->getConnection();
    $ssql = "INSERT INTO states (name, country_id) VALUES (:name, :country_id)";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':name' => $data["name"],
      ':country_id' => $data["country_id"],
    ]);
  }

  public function belongsToCountry($state_id, $country_id) {
    $state = $this->getId($state_id);
    if(! $state) {
      return false;
    }
    return $state["country_id"] == $country_id;
  }
}