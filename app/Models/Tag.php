<?php

namespace App\Models;

class Tag extends Model {

  public function __construct() {
    $this->table = 'tags';
  }

  public function insert($data) {
    $pdo = $this->getConnection();
    $ssql = "INSERT INTO tags (name, description) VALUES (:name, :description)";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':name' => $data["name"],
      ':description' => $data["description"],
    ]);
  }

  public function update($data) {
    $pdo = $this->getConnection();
    $ssql = "UPDATE tags SET name=:name, description=:description WHERE id=:id";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':name' => $data["name"],
      ':description' => $data["description"],
      ':id' => $data["id"],
    ]);
  }

  public function delete($id) {
    $pdo = $this->getConnection();
    $ssql = "DELETE FROM tags where id=:id";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':id' => $id,
    ]);
  }
}