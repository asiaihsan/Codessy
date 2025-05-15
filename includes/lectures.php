<?php
require_once 'nav.php';
require_once 'config.php';
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
    <a class="navbar-brand" href="#">HTML Tutorial</a>
    <a class="navbar-brand" href="#">CSS Tutorial</a>
    <a class="navbar-brand" href="#">JavaScript Tutorial</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
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