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
}