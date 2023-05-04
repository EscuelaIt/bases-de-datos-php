<section class="box">
  <h2><?= $formTitle ?></h2>
  <?= $this->insert('partials/form-errors', [
        'errors' => $errors,
  ]); ?>
  <form action="<?= $action ?>" method="post">
    <input type="hidden" name="id" value="<?= isset($old['id']) ? $old['id'] : '' ?>">
    <p>
      <label for="name">Nombre provincia:</label>
      <input type="text" name="name" id="name" value="<?= isset($old['name']) ? $old['name'] : '' ?>">
    </p>
    <button><?= $label ?></button>
  </form>
</section>