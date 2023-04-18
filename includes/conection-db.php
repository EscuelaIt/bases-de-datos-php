<?php
function generateConection() {
  $host = $_ENV["DB_HOST"];
  $user = $_ENV["DB_USER"];
  $password = $_ENV["DB_PASSWORD"];
  $db = $_ENV["DB_DB"];

  $mysqli = new mysqli($host, $user, $password, $db);
  if($mysqli->connect_errno) {
    echo "Error de conexión con la base de datos: " . $mysqli->connect_errno;	
    exit;
  } else {
    return $mysqli;
  }
}
?>