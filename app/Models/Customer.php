<?php

namespace App\Models;

use App\Log;

class Customer extends Model {

  public function __construct() {
    $this->table = 'customers';
  }

  protected function getAllSql() {
    return "SELECT customers.*, countries.name as 'country', states.name as 'state'  FROM customers, countries, states WHERE customers.country_id = countries.id and customers.state_id = states.id";
  }

  protected function getIdSql() {
    return "SELECT customers.*, countries.name as 'country' FROM customers, countries where customers.id=:id and customers.country_id = countries.id";
  }

  public function insert($data) {
    $pdo = $this->getConnection();
    $ssql = "INSERT INTO customers (name, email, address, country_id, state_id) VALUES (:name, :email, :address, :country_id, :state_id)";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':name' => $data["name"],
      ':email' => $data["email"],
      ':address' => $data["address"],
      ':country_id' => $data["country_id"],
      ':state_id' => $data["state_id"],
    ]);
  }
  
  public function delete($id) {
    $pdo = $this->getConnection();
    $ssql = "DELETE FROM customers WHERE id=:id";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':id' => $id,
    ]);
  }

  public function update($data) {
    $pdo = $this->getConnection();
    $ssql = "UPDATE customers SET name=:name, email=:email, address=:address, country_id=:country_id, state_id=:state_id WHERE id=:id";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':name' => $data["name"],
      ':email' => $data["email"],
      ':address' => $data["address"],
      ':country_id' => $data["country_id"],
      ':state_id' => $data["state_id"],
      ':id' => $data["id"],
    ]);
  }

  public function hasTagAssociated($customerId, $tagId) {
    $pdo = $this->getConnection();
    $ssql = "SELECT COUNT(*) AS num FROM customer_tag WHERE customer_id=:customerId and tag_id=:tagId";
    $statement = $pdo->prepare($ssql);
    $statement->execute([
      ':customerId' => $customerId,
      ':tagId' => $tagId,
    ]);
    $row = $statement->fetch();
    return $row["num"] > 0;
  }

  public function associateTag($customerId, $tagId) {
    $pdo = $this->getConnection();
    // $customerId = $pdo->real_escape_string($customerId);
    // $tagId = $pdo->real_escape_string($tagId);
    $ssql = "Insert into customer_tag (customer_id, tag_id) values (:customerId, :tagId)";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':customerId' => $customerId,
      ':tagId' => $tagId,
    ]);
  }

  public function getCustomerTags($customerId) {
    $pdo = $this->getConnection();
    $ssql = "SELECT tags.* from tags, customer_tag WHERE customer_tag.customer_id=:customerId and customer_tag.tag_id=tags.id";
    $statement = $pdo->prepare($ssql);
    $statement->execute([
      ':customerId' => $customerId
    ]);
    return $statement->fetchAll();
  }

  public function unAssociateTag($customerId, $tagId) {
    $pdo = $this->getConnection();
    // $customerId = $pdo->real_escape_string($customerId);
    // $tagId = $pdo->real_escape_string($tagId);
    $ssql = "delete from customer_tag where customer_id=:customerId and tag_id=:tagId";
    $statement = $pdo->prepare($ssql);
    return $statement->execute([
      ':customerId' => $customerId,
      ':tagId' => $tagId,
    ]);
  }
}