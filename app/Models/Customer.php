<?php

namespace App\Models;

class Customer extends Model {

  public function getAll() {
    $mysqli = $this->getConnection();

    $ssql = "SELECT * FROM customers";
    $result = $mysqli->query($ssql);
    $allRows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $allRows;
  }

  public function insert($data) {
    $mysqli = $this->getConnection();

    $name = $mysqli->real_escape_string($data["name"]);
    $email = $mysqli->real_escape_string($data["email"]);
    $address = $mysqli->real_escape_string($data["address"]);
  
    $ssql = "INSERT INTO customers (name, email, address) VALUES ('{$name}', '{$email}', '{$address}')";
    return $mysqli->query($ssql);
  }
  
  public function delete($id) {
    $mysqli = $this->getConnection();

    $id = $mysqli->real_escape_string($id);
    $ssql = "DELETE FROM customers WHERE id={$id}";
    return $mysqli->query($ssql);
  }

  public function getId($id) {
    $mysqli = $this->getConnection();
    $id = $mysqli->real_escape_string($_GET["id"]);
    $ssql = "SELECT * FROM customers where id={$id}";
    $result = $mysqli->query($ssql);
    if($result && $result->num_rows != 1) {
      return null;
    } else {
      return $result->fetch_assoc();
    }
  }

  public function update($data) {
    $mysqli = $this->getConnection();
    $name = $mysqli->real_escape_string($data["name"]);
    $email = $mysqli->real_escape_string($data["email"]);
    $address = $mysqli->real_escape_string($data["address"]);
    $id = $mysqli->real_escape_string($data["id"]);

    $ssql = "UPDATE customers SET name='{$name}', email='{$email}', address='{$address}' WHERE id={$id}";
    return $mysqli->query($ssql);
  }
}