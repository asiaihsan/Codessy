<?php
require_once '../config.php';
require_once 'admin_nav.php';

if (!$session->isAdminLoggedIn()) {
    header("Location: admin_login.php");
    exit();
}

// Handle quiz creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $code = $_POST['code'];
    $course = $_POST['language_id'];
    $lecture = $_POST['lecture_id'];
    $answer = $_POST['answer'];
    $adminID = $session->adminID;

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

// Get all courses and lectures
$stmt = $pdo->query("SELECT * FROM programing_language");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM lectures WHERE admin_id = '$session->adminID'");
$lectures = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle session messages
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_quiz.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-question-circle"></i> Create Quiz
                        </h5>
                        <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- Success/Error Messages -->
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <!-- Quiz Form -->
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">
                                        <i class="bi bi-question-circle"></i> Quiz Title
                                    </label>
                                    <input type="text" class="form-control" id="title" 
                                           name="title" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="language_id" class="form-label">
                                        <i class="bi bi-code-slash"></i> Programming Language
                                    </label>
                                    <select id="language_id" name="language_id" 
                                            class="form-select" required>
                                        <option value="" disabled selected>Select a language</option>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo htmlspecialchars($course['id']); ?>">
                                                <?php echo htmlspecialchars($course['language_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lecture_id" class="form-label">
                                        <i class="bi bi-book"></i> Lecture
                                    </label>
                                    <select id="lecture_id" name="lecture_id" 
                                            class="form-select" required>
                                        <option value="" disabled selected>Select a lecture</option>
                                        <?php foreach ($lectures as $lecture): ?>
                                            <option value="<?php echo htmlspecialchars($lecture['id']); ?>">
                                                <?php echo htmlspecialchars($lecture['lecture_title']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="content" class="form-label">
                                        <i class="bi bi-file-text"></i> Quiz Content
                                    </label>
                                    <textarea class="form-control" id="content" 
                                              name="content" rows="3" required></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="code" class="form-label">
                                        <i class="bi bi-code"></i> Quiz Code
                                    </label>
                                    <div class="code-editor">
                                        <textarea id="code" name="code" class="form-control" 
                                                  rows="10" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="answer" class="form-label">
                                        <i class="bi bi-check2-circle"></i> Correct Answer
                                    </label>
                                    <input type="text" class="form-control" id="answer" 
                                           name="answer" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
