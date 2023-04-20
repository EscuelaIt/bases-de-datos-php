<div class="feedback feedback-<?= $status ?>">
  <ul>
    <?php foreach($messages as $message): ?>
      <li><?= $message ?></li>
    <?php endforeach ?>
  </ul>
</div>