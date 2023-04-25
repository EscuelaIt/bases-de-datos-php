<?php

namespace App\Models;

class Model {

  protected $table;

  protected function getConnection() {
    return Connection::getInstance()->getConnection();  
  }

  public function getAll() {
    $mysqli = $this->getConnection();
    $ssql = $this->getAllSql();
    $result = $mysqli->query($ssql);
    $allRows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $allRows;
  }

  protected function getAllSql() {
    return "SELECT * FROM {$this->table}";
  }
}