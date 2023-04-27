<?php

namespace App\Models;

use PDO;
use App\Log;

class Connection {
  private static $instance;
  private $connection;

  private function __construct() {
    $host = $_ENV["DB_HOST"];
    $user = $_ENV["DB_USER"];
    $password = $_ENV["DB_PASSWORD"];
    $db = $_ENV["DB_DB"];

    $dsn = "sqlite:/Users/midesweb/proyectos/bbdd_php/db/proyecto.db";
    try {
      $this->connection = new PDO($dsn, $user, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);  
    } catch(PDOException $e) {
      echo "Error de conexión con la base de datos: " . $e->getMessage();	
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
}




