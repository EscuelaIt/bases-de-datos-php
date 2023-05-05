<?php

namespace App\Models;

class Tag extends Model {

  private $statements;

  public function __construct() {
    $this->table = 'tags';
    $pdo = $this->getConnection();
    $this->statements = [
      'insert' => $pdo->prepare("INSERT INTO tags (name, description) VALUES (:name, :description)"),
      'update' => $pdo->prepare("UPDATE tags SET name=:name, description=:description WHERE id=:id"),
      'delete' => $pdo->prepare("DELETE FROM tags where id=:id"),
    ];
  }

  public function insert($data) {
    return $this->statements['insert']->execute([
      ':name' => $data["name"],
      ':description' => $data["description"],
    ]);
  }

  public function update($data) {
    return $this->statements['update']->execute([
      ':name' => $data["name"],
      ':description' => $data["description"],
      ':id' => $data["id"],
    ]);
  }

  public function delete($id) {
    return $this->statements['delete']->execute([
      ':id' => $id,
    ]);
  }

  public function existsByName($name) {
    $pdo = $this->getConnection();
    $ssql = "SELECT COUNT(*) AS num FROM {$this->table} WHERE name like :name";
    $statement = $pdo->prepare($ssql);
    $statement->execute([
      ':name' => $name,
    ]);
    $row = $statement->fetch();
    return $row["num"] > 0;
  }

  public function getByName($name) {
    $pdo = $this->getConnection();
    $ssql = "SELECT * FROM {$this->table} where name=:name";
    $statement = $pdo->prepare($ssql);
    $statement->execute([
      ':name' => $name
    ]);
    if($statement && $statement->rowCount() != 1) {
      return null;
    } else {
      return $statement->fetch();
    }
  }
}