<?php
  include './vendor/autoload.php';
  include './includes/enviroment.php';
  include './includes/conection-db.php';
  include './includes/templates.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
  <?php
    $mysqli = generateConection();

    if($_POST) {
      $name = $mysqli->real_escape_string($_POST["name"]);
      $email = $mysqli->real_escape_string($_POST["email"]);
      $address = $mysqli->real_escape_string($_POST["address"]);
      $id = $mysqli->real_escape_string($_POST["id"]);

      $ssql = "UPDATE customers SET name='{$name}', email='{$email}', address='{$address}' WHERE id={$id}";
      if($mysqli->query($ssql)) {
        echo "<p>El cliente se ha editado</p>";
      }
    } else {
      $id = $_GET["id"] ?? null;
      if($id && ctype_digit($id)) {
        $id = $mysqli->real_escape_string($id);
        $ssql = "SELECT * FROM customers WHERE id={$id}";
        $result = $mysqli->query($ssql);
        if($result->num_rows == 0) {
          echo '<p>No he encontrado ese elemento</p>';
        } else {
          $customer = $result->fetch_assoc();
          echo $templates->render('customer-form', [
            'formTitle' => 'Editar un cliente',
            'label' => 'Guardar',
            'action' => 'editar.php',
            'old' => $customer,
          ]);
        }
      } else {
        echo '<p>No he recibido el identificador</p>';
      }
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