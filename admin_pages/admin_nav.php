<?php
require_once '../config.php';

if (!$session->isAdminLoggedIn()) {
    header("Location: ad123min_login.php");
    exit();
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin_dashbaord.php">dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create_lecture.php">Create Lecture</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="create_quiz.php">Create Quiz</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="admin_profile.php">View Profile</a></li>
            <?php if(isset($_SESSION['adminID']) && $_SESSION['adminID']=== 1): ?>
            <li><a class="dropdown-item" href="add_admin.php">Add Admin</a></li>
            <?php endif; ?>
          </ul>
        </li>
       
      </ul>
      <div class="d-flex" >
         
          <a href="?admin_logout" class="nav-link " aria-disabled="true">Logout</a>
        
       
      </div>
    </div>
  </div>
</nav>
</body>
</html>