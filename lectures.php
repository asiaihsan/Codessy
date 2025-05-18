<?php

require_once 'nav.php';
require_once 'config.php';



$id = $_GET['language_id'] ;

$lecture_id = isset($_GET['lecture_id']);
if (!isset($lecture_id)) {
    $lecture_id = 1; // Default value if not set
} else {
    $lecture_id = isset($_GET['lecture_id']);
}



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
    $result = $pdo->query("SELECT * FROM programing_language WHERE id = " . intval($id));
    foreach ($result as $row) { ?>
        <label class="navbar-brand" ><?php echo htmlspecialchars($row['language_name']); ?> Tutorial</label>
    <?php } ?>
  
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php
          $result = $pdo->query("SELECT * FROM  lectures WHERE language_id = " . intval($id));
          foreach ($result as $row) { ?>
            <a class="nav-link active" aria-current="page" href="lectures.php?lecture_id=<?php echo htmlspecialchars($row['id']); ?>&language_id=<?php echo htmlspecialchars($id); ?>"><?php echo htmlspecialchars($row['lecture_title']); ?></a>
          <?php } ?>
          
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php

$id = $_GET['language_id'] ;
$lecture_id = 0;
if (!isset($_GET['lecture_id'])) {
  $sql="SELECT id FROM lectures WHERE language_id = " . intval($id) . " LIMIT 1";
  $result = $pdo->query($sql);
  $lecture_id = $result->fetchColumn(); // Get the first lecture ID
} else {
  $lecture_id = $_GET['lecture_id'];
}

// Check if user is logged in and handle lecture completion
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
    
    // First check if the lecture is already completed
    $check_sql = "SELECT * FROM completed_lectures WHERE user_id = " . intval($userID) . " AND lecture_id = " . intval($lecture_id);
    $check_result = $pdo->query($check_sql);
    
    if (!$check_result->fetch()) {
        // If not completed, insert the completion
        $insert_sql = "INSERT INTO completed_lectures (user_id, language_id, lecture_id, created_at) 
                      VALUES (" . intval($userID) . ", " . intval($id) . ", " . intval($lecture_id) . ", NOW())";
        if ($pdo->query($insert_sql)) {
            $_SESSION['message'] = '<div class="alert alert-success">Lecture completed successfully!</div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">Error saving your progress.</div>';
        }
    }
} else {
    $_SESSION['message'] = '<div class="alert alert-warning">Please log in to save your progress.</div>';
}

?>


<div class="container">
  <h1>Welcome to the  Tutorials</h1>
    <div class="left">
        <div>
            <label for="">Example</label>
        </div>
        <?php
        $result = $pdo->query("SELECT lecture_code FROM lectures JOIN programing_language ON lectures.language_id = programing_language.id WHERE lectures.id = " . intval($lecture_id) . " AND programing_language.id = " . intval($id));
        foreach ($result as $row) { ?>
            <div class="example">
                <pre><code><?php echo htmlspecialchars($row['lecture_code']); ?></code></pre>
            </div>
        <?php } ?>
        <div class="button">
            <a href="run.php?language_id=<?php echo htmlspecialchars($id); ?>&lecture_id=<?php echo htmlspecialchars($lecture_id); ?>" class="btn btn-primary">Try it Yourself</a>
        </div>
        <div class="button">
          <a href="quiz.php?lecture_id=<?php echo htmlspecialchars($lecture_id); ?>&language_id=<?php echo htmlspecialchars($id); ?>" class="btn btn-primary">Take Quiz</a>
        </div>
    </div>
</div>

</body>
</html>