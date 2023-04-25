<section class="box">
  <h2>Clientes</h2>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Dirección</th>
      <th>País</th>
    </tr>  
    <?php foreach($customers as $customer): ?>
        <tr>
          <td><?= $customer['name'] ?></td>
          <td><?= $customer['email'] ?></td>
          <td><?= $customer['address'] ?></td>
          <td><?= $customer['country'] ?></td>
          <td class="control"><a href="editar.php?id=<?= $customer['id'] ?>">[ Editar ]</a></td>
          <td class="control"><a href="borrar.php?id=<?= $customer['id'] ?>">[ Borrar ]</a></td>
        </tr>
    <?php endforeach ?>
  </table>
</section>
