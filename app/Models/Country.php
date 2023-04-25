<?php

namespace App\Models;

class Country extends Model {

  public function __construct() {
    $this->table = 'countries';
  }

  public function exists($id) {
    $mysqli = $this->getConnection();
    $id = $mysqli->real_escape_string($id);
    $ssql = "SELECT COUNT(*) AS num FROM countries WHERE id={$id}";
    $result = $mysqli->query($ssql);
    $row = $result->fetch_assoc();
    $result->free();
    return $row["num"] > 0;
  }
}