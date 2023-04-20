<?php

namespace App\Models;

use App\Log;

class Connection {
  private static $instance;
  private $connection;

  private function __construct() {
    $host = $_ENV["DB_HOST"];
    $user = $_ENV["DB_USER"];
    $password = $_ENV["DB_PASSWORD"];
    $db = $_ENV["DB_DB"];

    $this->connection = new \mysqli($host, $user, $password, $db);
    if($this->connection->connect_errno) {
      echo "Error de conexión con la base de datos: " . $this->connection->connect_errno;	
      exit();
    }

    Log::log('Conexión abierta');
  }

  public static function getInstance() {
    if(! self::$instance) {
      self::$instance = new Connection();
    }
    return self::$instance;
  }

  public function getConnection() {
    return $this->connection;
  }

  function __destruct() {
    $this->connection->close();
    Log::log('Conexión cerrada');
  }
}




