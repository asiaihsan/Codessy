<?php

require_once '../config.php';

if (!$session->isAdminLoggedIn()) {
    header("Location:ad123min_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $code = $_POST['code'];
    $course = $_POST['language_id'];
    $lecture = $_POST['lecture_id'];
    $answer = $_POST['answer'];
    $adminID = $session->adminID;

    // Validate input
    if (empty($course) || empty($title) || empty($code)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        $sql = "INSERT INTO `quizzes` (`admin_id`,`language_id`, `lecture_id`, `quiz_title`,`quiz_content`, `quiz_code`, `quiz_answer`, `created_at`) VALUES ('$adminID', '$course', '$lecture', '$title', '$content', '$code', '$answer', NOW())";
        $stmt = $pdo->query($sql);
        if ($stmt) {
            $_SESSION['success'] = "Quiz created successfully.";
            header("Location: create_quiz.php");
            exit();
        } else {
            $_SESSION['error'] = "Error creating quiz.";
        }
    }
}

// Display messages if they exist
if (isset($_SESSION['success'])) {
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
</head>
<body>
    <h1>Create a New Quiz</h1>
    <form action="create_quiz.php" method="post">
        <label for="title">Quiz Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="content">Quiz Content:</label>
        <textarea id="content" name="content" required></textarea><br>

        <label for="code">Quiz Code:</label>
        <textarea id="code" name="code" required></textarea><br>

        <label for="language_id">Programming Language:</label>
        <select id="language_id" name="language_id" required>
            <option value="">Select a language</option>
            <?php
            $result = $pdo->query("SELECT * FROM programing_language");
            foreach ($result as $row) {
                echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['language_name']) . '</option>';
            }
            ?>
        </select><br>
        <label for="lecture_id">Lecture name:</label>
        <select id="lecture_id" name="lecture_id" required>
            <option value="">Select a lecture</option>
            <?php
            $result = $pdo->query("SELECT * FROM lectures");
            foreach ($result as $row) {
                echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['lecture_title']) . '</option>';
            }
            ?>
        </select><br>
        <label for="answer">Correct Answer:</label>
        <input type="text" id="answer" name="answer" required><br>

        <input type="submit" name="submit" value="Create Quiz">
    </form>
</body>
</html>

<?php
echo $session->adminID;
?>