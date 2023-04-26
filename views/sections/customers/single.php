<?php $this->layout('layouts/layout', [
  'title' => "Pagina de {$customer['name']}",
]) ?>

<p>
  Dirección: <?= $customer["address"] ?>
</p>
<p>
  (<?= $customer["country"] ?>)
</p>
<p>
  <a href="mailto:<?= $customer["email"] ?>"><?= $customer["email"] ?></a>
</p>

<section class="box">
  <ul class="tag-chips">
    <?php foreach($customerTags as $customerTag): ?>
      <li><span><?= $customerTag["name"] ?></span> <a href="/clientes/<?= $customer["id"] ?>/desvincular-tag/<?= $customerTag["id"] ?>">x</a> </li>
    <?php endforeach ?>
  </ul>
  <form action="/clientes/<?= $customer["id"] ?>/asociar-tag" method="post">
    <select name="tag_id">
      <?php foreach($tags as $tag): ?>
        <option value="<?= $tag["id"] ?>"><?= $tag["name"] ?></option>
      <?php endforeach ?>
    </select>
    <button class="button-mini">Asociar Tag</button>
  </form>
</section>

<a href="/clientes">Volver</a>