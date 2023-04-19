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
  include './includes/validation.php';
  include './includes/templates.php';

  $errors = validateCustomer($_POST);
  
  if(count($errors) == 0) {
    $customerModel = new App\Models\Customer();
    if($customerModel->insert($_POST)) {
      echo "<p>Cliente insertado</p>";
    }
  } else {
    echo $templates->render('customer-form', [
      'formTitle' => 'Insertar un cliente',
      'label' => 'Insertar',
      'action' => 'insertar.php',
      'old' => $_POST,
      'errors' => $errors,
    ]);
  }
  ?>
  <p>
    <a href=".">Volver</a>
  </p>
  </div>

</body>
</html>