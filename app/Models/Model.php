<?php

namespace App\Models;

class Model {

  protected $table;

  protected function getConnection() {
    return Connection::getInstance()->getConnection();  
  }

  public function getAll() {
    $pdo = $this->getConnection();
    $ssql = $this->getAllSql();
    $result = $pdo->query($ssql);
    $allRows = $result->fetchAll();
    return $allRows;
  }

  protected function getAllSql() {
    return "SELECT * FROM {$this->table}";
  }

  public function exists($id) {
    $pdo = $this->getConnection();
    $ssql = "SELECT COUNT(*) AS num FROM {$this->table} WHERE id=:id";
    $statement = $pdo->prepare($ssql);
    $statement->execute([
      ':id' => $id,
    ]);
    $row = $statement->fetch();
    return $row["num"] > 0;
  }

  public function getId($id) {
    $pdo = $this->getConnection();
    $ssql = $this->getIdSql();
    $statement = $pdo->prepare($ssql);
    $statement->execute([
      ':id' => $id,
    ]);
    if(! $statement || $statement->rowCount() != 1) {
      return null;
    } else {
      return $statement->fetch();
    }
  }

  protected function getIdSql() {
    return "SELECT * FROM {$this->table} where id=:id";
  }

}