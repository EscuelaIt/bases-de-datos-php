<?php
include './vendor/autoload.php';
include './includes/enviroment.php';
include './includes/templates.php';
include './includes/conection-db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bases de datos con PHP</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Curso de bases de datos con PHP</h1>
    <?= $templates->render('customer-form', [
      'formTitle' => 'Insertar un cliente',
      'label' => 'Insertar',
      'action' => 'insertar.php',
      'old' => [],
    ]) ?>

    <section class="box">
      <h2>Clientes</h2>
      <table>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Dirección</th>
        </tr>  
        <?php
        $mysqli = generateConection();

        $ssql = "SELECT * FROM customers";
        $result = $mysqli->query($ssql);
        while($customer = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $customer['name'] ?></td>
              <td><?= $customer['email'] ?></td>
              <td><?= $customer['address'] ?></td>
              <td><a href="editar.php?id=<?= $customer['id'] ?>">[ Editar ]</a></td>
              <td><a href="borrar.php?id=<?= $customer['id'] ?>">[ Borrar ]</a></td>
            </tr>
          <?php
        }
        $result->free();
        ?>
      </table>
    </section>
  </div>
</body>
</html>
<?php
$mysqli->close();
?>