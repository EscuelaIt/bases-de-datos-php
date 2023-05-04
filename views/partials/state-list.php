<section class="box">
  <h2>Provincias</h2>
  <table>
    <tr>
      <th>id</th>
      <th>Nombre</th>
    </tr>
    <?php foreach($states as $state): ?>
      <tr>
        <td><?= $state["id"] ?></td>
        <td><?= $state["name"] ?></td>
      </tr>
    <?php endforeach ?>
  </table>
</section>