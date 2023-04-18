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
    <section class="box">
      <h2>Insertar cliente</h2>
      <form action="insertar.php" method="post">
        <p>
          <label for="name">Nombre:</label>
          <input type="text" name="name" id="name">
        </p>
        <p>
          <label for="email">Email:</label>
          <input type="text" name="email" id="email">
        </p>
        <p>
          <label for="address">Dirección postal:</label>
          <input type="text" name="address" id="address">
        </p>
        <button>Insertar</button>
      </form>
    </section>

    <section class="box">
      <h2>Clientes</h2>
      <table>
        <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Dirección</th>
        </tr>  
        <?php
        include './includes/conection-db.php';
        $mysqli = generateConection();

        $ssql = "SELECT * FROM customers";
        $result = $mysqli->query($ssql);
        while($customer = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $customer['name'] ?></td>
              <td><?= $customer['email'] ?></td>
              <td><?= $customer['address'] ?></td>
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