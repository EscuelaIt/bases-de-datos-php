<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insertar</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">

  <?php
  include './includes/conection-db.php';
  $mysqli = generateConection();
  
  $name = $mysqli->real_escape_string($_POST["name"]);
  $email = $mysqli->real_escape_string($_POST["email"]);
  $address = $mysqli->real_escape_string($_POST["address"]);

  $ssql = "INSERT INTO customers (name, email, address) VALUES ('{$name}', '{$email}', '{$address}')";
  if($mysqli->query($ssql)) {
    echo "<p>Cliente insertado</p>";
  }
  ?>
  <p>
    <a href=".">Volver</a>
  </p>
  </div>

</body>
</html>
<?php
$mysqli->close();
?>