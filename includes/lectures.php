<?php
require_once 'nav.php';
require_once 'config.php';

$id = $_GET['language_id'] ;
echo "language_id: " . htmlspecialchars($id) . "<br>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <?php
    $sql = "SELECT * FROM programing_language WHERE id = " . intval($id);
    $result = $pdo->query($sql);
    foreach ($result as $row) { ?>
        <a class="navbar-brand" href="#"><?php echo htmlspecialchars($row['language_name']); ?> Tutorial</a>
    <?php } ?>
  
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php
          $sql = "SELECT * FROM  lectures WHERE language_id = " . intval($id);
          $result = $pdo->query($sql);
          foreach ($result as $row) { ?>
            <a class="nav-link active" aria-current="page" href="#"><?php echo htmlspecialchars($row['lecture_title']); ?></a>
          <?php } ?>
          
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <h1>Welcome to the  Tutorials</h1>
    <div class="left">
        <div>
            <label for="">Example</label>
        </div>
        <div class="editor">
            this is an example
        </div>
        <div class="button">
            <a href="" class="btn btn-primary">Try it Yourself</a>
        </div>
    </div>
</body>
</html>