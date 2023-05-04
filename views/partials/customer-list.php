<section class="box">
  <h2>Clientes</h2>
  <table>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Dirección</th>
      <th>País</th>
      <th>Provincia</th>
    </tr>  
    <?php foreach($customers as $customer): ?>
        <tr>
          <td>
            <a href="/clientes/<?= $customer['id'] ?>"><?= $customer['name'] ?></a>
          </td>
          <td><?= $customer['email'] ?></td>
          <td><?= $customer['address'] ?></td>
          <td><?= $customer['country'] ?></td>
          <td><?= $customer['state'] ?></td>
          <td class="control"><a href="/clientes/editar?id=<?= $customer['id'] ?>">[ Editar ]</a></td>
          <td class="control"><a href="/clientes/borrar?id=<?= $customer['id'] ?>">[ Borrar ]</a></td>
        </tr>
    <?php endforeach ?>
  </table>
</section>
