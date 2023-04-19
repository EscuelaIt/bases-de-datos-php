<?php if(isset($errors) && count($errors) > 0): ?>
  <div class="errors">
    <h2>Errores en el formulario:</h2>
    <ul>
      <?php foreach($errors as $error): ?>
        <li>
          <?= $error ?>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif ?>