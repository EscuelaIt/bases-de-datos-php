<?php
  include './vendor/autoload.php';
  include './includes/enviroment.php';
  include './includes/templates.php';
  include './includes/validation.php';
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

    $customerModel = new App\Models\Customer();

    if($_POST) {
      $errors = validateCustomer($_POST);
      if(count($errors) == 0) {
        if($customerModel->update($_POST)) {
          echo "<p>El cliente se ha editado</p>";
        }
      } else {
        echo $templates->render('customer-form', [
          'formTitle' => 'Editar un cliente',
          'label' => 'Guardar',
          'action' => 'editar.php',
          'old' => $_POST,
          'errors' => $errors,
        ]);
      }
    } else {
      $id = $_GET["id"] ?? null;
      if($id && ctype_digit($id)) {
        $customer = $customerModel->getId($id);
        if(! $customer) {
          echo '<p>No he encontrado ese elemento</p>';
        } else {
          echo $templates->render('customer-form', [
            'formTitle' => 'Editar un cliente',
            'label' => 'Guardar',
            'action' => 'editar.php',
            'old' => $customer,
            'errors' => [],
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