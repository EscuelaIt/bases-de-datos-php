<section class="box">
  <h2>Tags</h2>
  <?php if(count($tags) == 0): ?>
    <p>No tenemos etiquetas todavía</p>
  <?php else: ?>
    <table>
      <tr>
        <th>id</th>
        <th>Nombre</th>
        <th>Descripción</th>
      </tr>

      <?php foreach($tags as $tag): ?>
        <tr>
          <td><?= $tag["id"] ?></td>
          <td><?= $tag["name"] ?></td>
          <td><?= $tag["description"] ?></td>
          <td>
            [<a href="/etiquetas/editar/<?= $tag["id"] ?>">Editar</a>]
            [<a href="/etiquetas/borrar/<?= $tag["id"] ?>">Borrar</a>]
          </td>
        </tr>
      <?php endforeach ?>
    </table>
  <?php endif ?>
</section>