<?php

namespace App\Models;

use App\Log;

class Customer extends Model {

  public function __construct() {
    $this->table = 'customers';
  }

  protected function getAllSql() {
    return "SELECT customers.*, countries.name as 'country' FROM customers, countries WHERE customers.country_id = countries.id";
  }

  protected function getIdSql($id) {
    return "SELECT customers.*, countries.name as 'country' FROM customers, countries where customers.id={$id} and customers.country_id = countries.id";
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

  public function hasTagAssociated($customerId, $tagId) {
    $mysqli = $this->getConnection();
    $customerId = $mysqli->real_escape_string($customerId);
    $tagId = $mysqli->real_escape_string($tagId);
    
    $ssql = "SELECT COUNT(*) AS num FROM customer_tag WHERE customer_id={$customerId} and tag_id={$tagId}";
    Log::log($ssql);
    $result = $mysqli->query($ssql);
    $row = $result->fetch_assoc();
    return $row["num"] > 0;
  }

  public function associateTag($customerId, $tagId) {
    $mysqli = $this->getConnection();
    $customerId = $mysqli->real_escape_string($customerId);
    $tagId = $mysqli->real_escape_string($tagId);

    $ssql = "Insert into customer_tag (customer_id, tag_id) values ({$customerId}, {$tagId})";
    return $mysqli->query($ssql);
  }

  public function getCustomerTags($customerId) {
    $mysqli = $this->getConnection();
    $ssql = "SELECT tags.* from tags, customer_tag WHERE customer_tag.customer_id={$customerId} and customer_tag.tag_id=tags.id";
    $result = $mysqli->query($ssql);
    $allRows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $allRows;
  }

  public function unAssociateTag($customerId, $tagId) {
    $mysqli = $this->getConnection();
    $customerId = $mysqli->real_escape_string($customerId);
    $tagId = $mysqli->real_escape_string($tagId);

    $ssql = "delete from customer_tag where customer_id={$customerId} and tag_id={$tagId}";
    return $mysqli->query($ssql);
  }
}