<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <?= App\Feedback::showFeedback($this) ?>

    <h1><?= $title ?></h1>
    <?=$this->section('content')?>

  </div>
</body>
</html>