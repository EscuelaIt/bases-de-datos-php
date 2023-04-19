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
  include './vendor/autoload.php';
  include './includes/enviroment.php';
  
  $id = $_GET["id"] ?? null;
  if($id && ctype_digit($id)) {
    $customerModel = new App\Models\Customer();
    if($customerModel->delete($id)) {
      echo "<p>Se ha borrado el cliente</p>";
    }
  } else {
    echo "<p>No se ha recibido el identificador del cliente</p>";
  }
  ?>
  <p>
    <a href=".">Volver</a>
  </p>
  </div>

</body>
</html>