<section class="box">
  <h2><?= $formTitle ?></h2>

  <?= $this->insert('partials/form-errors', [
    'errors' => $errors,
  ])?>

  <form action="<?= $action ?>" method="post">
    <input type="hidden" name="id" value="<?= $old["id"] ?? '' ?>">
    <p>
      <label for="name">Nombre:</label>
      <input type="text" name="name" id="name" value="<?= $old["name"] ?? '' ?>" >
    </p>
    <p>
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" value="<?= $old["email"] ?? '' ?>">
    </p>
    <p>
      <label for="address">Dirección postal:</label>
      <input type="text" name="address" id="address" value="<?= $old["address"] ?? '' ?>">
    </p>
    <button><?= $label ?></button>
  </form>
</section>