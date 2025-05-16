<?php
require_once 'config.php';

if(isset($_GET['language_id'])) {
    echo "language_id: " . htmlspecialchars($_GET['language_id']) . "<br>";
} else{
$_GET['language_id'] = 1;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"></script>
    <title>Navigation_top</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Codessy</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <?php
      $result = $pdo->query("SELECT * FROM programing_language");
      foreach ($result as $row) { ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="lectures.php?language_id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['language_name']); ?></a>
        </li>
      <?php } 
      
      
      
      ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Quizzes</a>
        </li>
      </ul>
      <?php
      if(!isset($_SESSION['username']) ) { ?>
       <div class="d-flex" role="search">
        <a href="login.php" class="btn btn-primary">Sign In</a>
        <a href="sign_up.php" class="btn text-primary">Sign Up</a>
      </div>
      <?php } else if(isset($_SESSION['username'])) { ?>
        
        <a class="btn btn-primary" href="?logout">Logout</a>
       
      <?php } ?>
    </div>
  </div>
</nav>
</body>
</html>