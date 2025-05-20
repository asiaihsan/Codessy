<?php
require_once '../config.php';
require_once '../config.php';

if (!$session->isAdminLoggedIn()) {
    header("Location: ad123min_login.php");
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
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codessy Admin - Create Quiz</title>
    <link rel="stylesheet" href="../css/admin_quiz.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <div class="admin-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Create New Quiz</h5>
                            <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (isset($success)): ?>
                                <div class="alert alert-success">
                                    <?php echo htmlspecialchars($success); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($error); ?>
                                </div>
                            <?php endif; ?>

                            <form action="create_quiz.php" method="POST" class="quiz-form">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">
                                            <i class="bi bi-question-circle"></i> Quiz Title
                                        </label>
                                        <input type="text" id="title" name="title" 
                                               class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="language_id" class="form-label">
                                            <i class="bi bi-code-slash"></i> Programming Language
                                        </label>
                                        <select id="language_id" name="language_id" 
                                                class="form-select" required>
                                            <option value="">Select a language</option>
                                            <?php
                                            $result = $pdo->query("SELECT * FROM programing_language");
                                            foreach ($result as $row) {
                                                echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['language_name']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="content" class="form-label">
                                            <i class="bi bi-text-paragraph"></i> Quiz Content
                                        </label>
                                        <textarea id="content" name="content" 
                                                  class="form-control" required rows="3"></textarea>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="code" class="form-label">
                                            <i class="bi bi-code"></i> Quiz Code
                                        </label>
                                        <textarea id="code" name="code" 
                                                  class="form-control code-editor" required rows="8"></textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="lecture_id" class="form-label">
                                            <i class="bi bi-book"></i> Related Lecture
                                        </label>
                                        <select id="lecture_id" name="lecture_id" 
                                                class="form-select" required>
                                            <option value="">Select a lecture</option>
                                            <?php
                                            $result = $pdo->query("SELECT * FROM lectures WHERE admin_id = " . $_SESSION['adminID']);
                                            foreach ($result as $row) {
                                                echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['lecture_title']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="answer" class="form-label">
                                            <i class="bi bi-check2"></i> Correct Answer
                                        </label>
                                        <input type="text" id="answer" name="answer" 
                                               class="form-control" required>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Create Quiz
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
