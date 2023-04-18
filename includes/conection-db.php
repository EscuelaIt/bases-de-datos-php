<?php
function generateConection() {
  $mysqli = new mysqli("localhost", "userdb", "1234qwer!A", "curso_bd");
  if($mysqli->connect_errno) {
    echo "Error de conexión con la base de datos: " . $mysqli->connect_errno;	
    exit;
  } else {
    return $mysqli;
  }
}
?>