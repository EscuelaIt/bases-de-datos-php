<?php

namespace App\Models;

class Tag extends Model {

  public function __construct() {
    $this->table = 'tags';
  }

  public function insert($data) {
    $mysqli = $this->getConnection();

    $name = $mysqli->real_escape_string($data["name"]);
    $description = $mysqli->real_escape_string($data["description"]);

    $ssql = "INSERT INTO tags (name, description) VALUES ('{$name}', '{$description}')";
    return $mysqli->query($ssql);
  }

  public function update($data) {
    $mysqli = $this->getConnection();
    $name = $mysqli->real_escape_string($data["name"]);
    $description = $mysqli->real_escape_string($data["description"]);
    $id = $mysqli->real_escape_string($data["id"]);

    $ssql = "UPDATE tags SET name='{$name}', description='{$description}' WHERE id={$id}";
    return $mysqli->query($ssql);
  }

  public function delete($id) {
    $mysqli = $this->getConnection();
    $id = $mysqli->real_escape_string($id);
    $ssql = "DELETE FROM tags where id={$id}";
    return $mysqli->query($ssql);
  }
}