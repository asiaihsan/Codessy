<?php

require_once 'nav.php';
require_once 'config.php';

$id = $_GET['language_id'] ;
htmlspecialchars($id);
if (!isset($quiz_id)) {
  $sql="SELECT id FROM quizzes WHERE language_id = " . intval($id) . " LIMIT 1";
  $result = $pdo->query($sql);
  $quiz_id = $result->fetchColumn(); // Get the first quiz ID
}else{
$quiz_id = $_GET['quiz_id'] ;
}




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

            if (isset($session->userID)) {
                $userID = $session->userID;
                // Check if the quiz is already completed
                $check_sql = "SELECT * FROM completed_quizzes WHERE user_id = " . intval($userID) . " AND quiz_id = " . intval($current_quiz_id);
                $check_result = $pdo->query($check_sql);

                if (!$check_result->fetch()) {
                    // If not completed, insert the completion
                    $insert_sql = "INSERT INTO completed_quizzes (user_id, quiz_id,user_answer, created_at) VALUES (" . intval($userID) . ", " . intval($current_quiz_id) . ", '" . $userAnswer . "', NOW())";
                    if ($pdo->query($insert_sql)) {
                        $_SESSION['message'] = '<div class="alert alert-success">Quiz completed successfully!</div>';
                    } else {
                        $_SESSION['message'] = '<div class="alert alert-danger">Error saving your progress.</div>';
                    }
                }else{

                    $_SESSION['message'] = '<div class="alert alert-info">You have already completed this quiz.</div>';
                }
            }

            header("Location: quiz.php?quiz_id=" . $current_quiz_id . "&language_id=" . $id);
            exit();
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger">Incorrect answer. Please try again.</div>';
        }
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
    <link rel="stylesheet" href="css/quiz.css">
    <title>Quiz - Codessy</title>
</head>
<body class="body-quiz">
    <nav class="custom-quiz-nav">
        <div class="nav-container">
            <ul class="quiz-languages">
                <?php
                $result = $pdo->query("SELECT * FROM programing_language");
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $isActive = $row['id'] == $id;
                    $activeClass = $isActive ? 'active' : '';
                    ?>
                    <li class="language-item <?php echo $activeClass; ?>">
                        <a href="quiz.php?language_id=<?php echo $row['id']; ?>">
                            <span class="language-icon">
                                <i class="<?php echo strtolower(str_replace(' ', '-', $row['language_name'])); ?>-icon"></i>
                            </span>
                            <span class="language-name"><?php echo $row['language_name']; ?></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
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



    ?>


    <div class="container-quiz">
        <h1 class="quiz-title">Welcome to the Tutorials</h1>
        <div class="quiz-content">
            <div class="quiz-example">
                <div class="example-header">
                    <label class="example-label">Example</label>
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
                    <div class="quiz-description">
                        <p><?php echo htmlspecialchars($quiz_content); ?></p>
                    </div>
                    <div class="quiz-code">
                        <pre><code><?php echo htmlspecialchars($quiz_code); ?></code></pre>
                    </div>
                    <form class="quiz-form" action="quiz.php?quiz_id=<?php echo $current_quiz_id; ?>&language_id=<?php echo $id; ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control quiz-input" name="answer" id="answer" placeholder="Enter your answer">
                        </div>
                        <div class="quiz-buttons">
                            <button type="submit" name="submit" class="btn-quiz btn-submit">Submit</button>
                        </div>
                    </form>

                    <form class="quiz-nav-form" action="quiz.php" method="get">
                        <input type="hidden" name="language_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="quiz_id" value="<?php echo $current_quiz_id; ?>">
                        <button type="submit" name="next" class="btn-quiz btn-next">Next</button>
                    </form>
                    <?php
                    } else {
                        echo "<p class='no-quiz'>No quiz found for this language.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
