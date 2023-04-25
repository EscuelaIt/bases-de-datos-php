<?php

namespace App\Models;

class Customer extends Model {

  public function __construct() {
    $this->table = 'customers';
  }

  protected function getAllSql() {
    return "SELECT customers.*, countries.name as 'country' FROM customers, countries WHERE customers.country_id = countries.id";
  }

  public function insert($data) {
    $mysqli = $this->getConnection();

    $name = $mysqli->real_escape_string($data["name"]);
    $email = $mysqli->real_escape_string($data["email"]);
    $address = $mysqli->real_escape_string($data["address"]);
    $country_id = $mysqli->real_escape_string($data["country_id"]);
  
    $ssql = "INSERT INTO customers (name, email, address, country_id) VALUES ('{$name}', '{$email}', '{$address}', {$country_id})";
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
    $country_id = $mysqli->real_escape_string($data["country_id"]);
    $id = $mysqli->real_escape_string($data["id"]);

    $ssql = "UPDATE customers SET name='{$name}', email='{$email}', address='{$address}', country_id='{$country_id}' WHERE id={$id}";
    return $mysqli->query($ssql);
  }
}