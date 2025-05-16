<?php

require_once 'nav.php';
require_once 'config.php';

$id = $_GET['language_id'] ;
echo "language_id: " . htmlspecialchars($id) . "<br>";

if (!isset($quiz_id)) {
  $sql="SELECT id FROM quizzes WHERE language_id = " . intval($id) . " LIMIT 1";
  $result = $pdo->query($sql);
  $quiz_id = $result->fetchColumn(); // Get the first quiz ID
}else{
$quiz_id = $_GET['quiz_id'] ;
}
echo "quiz_id: " . htmlspecialchars($quiz_id) . "<br>";



if(isset($_POST['submit'])) {
    $answer = trim($_POST['answer']);
    $current_quiz_id = intval($_GET['quiz_id']); // Get quiz_id from URL
    
    // Get the specific quiz being answered
    $sql = "SELECT * FROM quizzes WHERE id = " . $current_quiz_id . " AND language_id = " . intval($id);
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        // Compare answers after trimming
        $userAnswer = trim($answer);
        $correctAnswer = trim($row['quiz_answer']);
        
        if ($userAnswer === $correctAnswer) {
            $_SESSION['message'] = '<div class="alert alert-success">Correct answer! Well done!</div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">Incorrect answer. The correct answer was: ' . htmlspecialchars($row['quiz_answer']) . '</div>';
        }
        // Redirect back to the same quiz
        header("Location: quiz.php?quiz_id=" . $current_quiz_id . "&language_id=" . $id);
        exit();
    }
}

// Display message if exists
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

if (isset($_GET['next'])) {
    // Find the next quiz with a higher ID for the same language
    $sql = "SELECT id FROM quizzes WHERE id > " . intval($quiz_id) . " AND language_id = " . intval($id) . " ORDER BY id ASC LIMIT 1";
    $result = $pdo->query($sql);
    $next_quiz_id = $result->fetchColumn();
    
    if ($next_quiz_id) {
        // Redirect to the next quiz
        header("Location: quiz.php?quiz_id=" . urlencode($next_quiz_id) . "&language_id=" . urlencode($id));
        exit;
    } else {
        echo "No more quizzes available for this language.<br>";
    }
}

// Get the current quiz data
$current_quiz_id = isset($_GET['quiz_id']) ? intval($_GET['quiz_id']) : null;
$lecture_id = isset($_GET['lecture_id']) ? intval($_GET['lecture_id']) : null;

if ($current_quiz_id) {
    $sql = "SELECT quizzes.*, programing_language.language_name 
            FROM quizzes 
            JOIN programing_language ON quizzes.language_id = programing_language.id 
            WHERE quizzes.id = " . $current_quiz_id . " 
            AND quizzes.language_id = " . intval($id);
    if ($lecture_id) {
        $sql .= " AND quizzes.lecture_id = " . intval($lecture_id);
    }
    $result = $pdo->query($sql);
    $current_quiz = $result->fetch(PDO::FETCH_ASSOC);
} else {
    // If no quiz_id provided, get the first quiz for this language
    $sql = "SELECT quizzes.*, programing_language.language_name 
            FROM quizzes 
            JOIN programing_language ON quizzes.language_id = programing_language.id 
            WHERE quizzes.language_id = " . intval($id);
    if ($lecture_id) {
        $sql .= " AND quizzes.lecture_id = " . intval($lecture_id);
    }
    $sql .= " LIMIT 1";
    $result = $pdo->query($sql);
    $current_quiz = $result->fetch(PDO::FETCH_ASSOC);
    if ($current_quiz) {
        $current_quiz_id = $current_quiz['id'];
    }
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
    $result = $pdo->query("SELECT * FROM programing_language");
    foreach ($result as $row) { ?>
        <a class="navbar-brand" href="quiz.php?language_id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['language_name']); ?> quiz</a>
    <?php } ?>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <?php
          $sql = "SELECT * FROM quizzes WHERE language_id = " . intval($id);
          if ($lecture_id) {
              $sql .= " AND lecture_id = " . intval($lecture_id);
          }
          $result = $pdo->query($sql);
          foreach ($result as $row) { ?>
            <a class="nav-link active" aria-current="page" href="quiz.php?language_id=<?php echo htmlspecialchars($id); ?>&quiz_id=<?php echo htmlspecialchars($row['id']); ?><?php echo $lecture_id ? '&lecture_id=' . htmlspecialchars($lecture_id) : ''; ?>"><?php echo htmlspecialchars($row['quiz_title']); ?></a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php

$id = $_GET['language_id'] ;
$quiz_id = 0;
if (!isset($_GET['quiz_id'])) {
  $sql="SELECT id FROM quizzes WHERE language_id = " . intval($id) . " LIMIT 1";
  $result = $pdo->query($sql);
  $quiz_id = $result->fetchColumn(); // Get the first quiz ID
  $row = $result->fetch(PDO::FETCH_ASSOC);
  if ($row) {
    $quiz_id = $row['id'];
  }
}else{
  $quiz_id = $_GET['quiz_id'] ;
}
// Validate and sanitize the input
echo "language_id: " . htmlspecialchars($id) . "<br>";
echo "quiz_id: " . htmlspecialchars($quiz_id) . "<br>";


?>


<div class="container">
  <h1>Welcome to the Tutorials</h1>
    <div class="left">
        <div>
            <label for="">Example</label>
        </div>
    <?php
    if ($current_quiz) {
        $lecture_id = $current_quiz['lecture_id'];
        $language_id = $current_quiz['language_id'];
        $quiz_title = $current_quiz['quiz_title'];
        $quiz_content = $current_quiz['quiz_content'];
        $quiz_code = $current_quiz['quiz_code'];
    ?>
        <h3><?php echo htmlspecialchars($quiz_title); ?></h3>
        <p><?php echo htmlspecialchars($quiz_content); ?></p>
        <p><?php echo htmlspecialchars($quiz_code); ?></p>
        <form action="quiz.php?quiz_id=<?php echo $current_quiz_id; ?>&language_id=<?php echo $id; ?>" method="post">
            <input type="text" name="answer" id="answer" placeholder="Enter your answer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

       <form action="quiz.php" method="get">
            <input type="hidden" name="language_id" value="<?php echo $id; ?>">
            <input type="hidden" name="quiz_id" value="<?php echo $current_quiz_id; ?>">
            <button type="submit" name="next" class="btn btn-primary">Next</button> 
        </form>
        <?php
        echo "Lecture ID: " . htmlspecialchars($lecture_id) . "<br>";
    } else {
        echo "No quiz found for this language.";
    }
    ?>
    </div>
</div>

</body>
</html>

