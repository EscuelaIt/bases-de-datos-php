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
    <p>
      <label for="country_id">País:</label>
      <select name="country_id" id="country_id">
        <option value="0">Selecciona el país</option>
        <?php foreach($countries as $country): ?>
          <option value="<?= $country["id"] ?>" <?= (isset($old["country_id"]) && $old["country_id"]  == $country["id"]) ? 'selected' : '' ?> >
            <?= $country["name"] ?>
        <?php endforeach ?>
      </select>
    </p>
    <p>
      
      <div id="states-select">
        Selecciona el país
      </div>
    </p>
    <button><?= $label ?></button>
  </form>
</section>

<?php foreach($countries as $country): ?>
  <div class="alternative-select" id="alternative-<?= $country["id"]?>">
    <label for="state_id_<?= $country["id"]?>">Provincia:</label>
    <select name="state_id" id="state_id_<?= $country["id"]?>"> 
      <option value="0">Selecciona la provincia</option>
      <?php foreach($stateModel->getCountryStates($country["id"]) as $state): ?>
        <option value="<?= $state["id"] ?>" <?= isset($old['state_id']) && $old['state_id'] == $state['id'] ? 'selected' : '' ?> ><?= $state["name"] ?></option>
      <?php endforeach ?>
    </select>
  </div>
<?php endforeach ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let countrySelect = document.getElementById('country_id');
    countrySelect.addEventListener('change', function(e) {
      console.log(this.value);
      displaySelect(this.value);
    });
    displaySelect(countrySelect.value);
  });

  function displaySelect(value) {
    console.log('displaySelect', value);
    let statesElement = document.getElementById('states-select');
    if(value == '' || value == '0') {
      statesElement.innerText = 'Selecciona un país'
    } else {
      statesElement.innerHTML = document.getElementById(`alternative-${value}`).innerHTML;
    }
  }
</script>
