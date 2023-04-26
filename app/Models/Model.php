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

  public function exists($id) {
    $mysqli = $this->getConnection();
    $id = $mysqli->real_escape_string($id);
    $ssql = "SELECT COUNT(*) AS num FROM {$this->table} WHERE id={$id}";
    $result = $mysqli->query($ssql);
    $row = $result->fetch_assoc();
    $result->free();
    return $row["num"] > 0;
  }

  public function getId($id) {
    $mysqli = $this->getConnection();
    $id = $mysqli->real_escape_string($id);
    $ssql = $this->getIdSql($id);
    $result = $mysqli->query($ssql);
    if($result && $result->num_rows != 1) {
      return null;
    } else {
      return $result->fetch_assoc();
    }
  }

  protected function getIdSql($id) {
    return "SELECT * FROM {$this->table} where id={$id}";
  }

}