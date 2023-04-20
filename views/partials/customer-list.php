<section class="box">
  <h2>Clientes</h2>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Dirección</th>
    </tr>  
    <?php foreach($customers as $customer): ?>
        <tr>
          <td><?= $customer['name'] ?></td>
          <td><?= $customer['email'] ?></td>
          <td><?= $customer['address'] ?></td>
          <td><a href="editar.php?id=<?= $customer['id'] ?>">[ Editar ]</a></td>
          <td><a href="borrar.php?id=<?= $customer['id'] ?>">[ Borrar ]</a></td>
        </tr>
    <?php endforeach ?>
  </table>
</section>
