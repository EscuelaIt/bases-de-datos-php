<section class="box">
  <h2>Países</h2>
  <table>
    <tr>
      <th>id</th>
      <th>Nombre</th>
    </tr>
    <?php foreach($countries as $country): ?>
      <tr>
        <td><?= $country["id"] ?></td>
        <td><a href="/paises/<?= $country["id"] ?>"><?= $country["name"] ?></a></td>
      </tr>
    <?php endforeach ?>
  </table>
</div>