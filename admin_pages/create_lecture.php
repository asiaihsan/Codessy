<?php
require_once '../config.php';
require_once 'admin_nav.php';

if (!$session->isAdminLoggedIn()) {
    header("Location: admin_login.php");
    exit();
}

// Handle lecture creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $course = $_POST['course'];
    $title = $_POST['title'];
    $code = $_POST['code'];
    $adminID = $session->adminID;

    if (empty($course) || empty($title) || empty($code)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        $sql = "INSERT INTO `lectures` (`admin_id`,`language_id`, `lecture_title`, `lecture_code`,`created_at`) VALUES ('$adminID', '$course', '$title', '$code', NOW())";
        $stmt = $pdo->query($sql);
        
        if ($stmt) {
            $_SESSION['success'] = "Lecture created successfully.";
            header("Location: create_lecture.php");
            exit();
        } else {
            $_SESSION['error'] = "Error creating lecture.";
        }
    }
}

// Get all courses
$stmt = $pdo->query("SELECT * FROM programing_language");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Codessy Admin - Create Lecture</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_lecture.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-book"></i> Create Lecture
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

                        <!-- Lecture Form -->
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="course" class="form-label">
                                        <i class="bi bi-code-slash"></i> Course
                                    </label>
                                    <select id="course" name="course" class="form-select" required>
                                        <option value="" disabled selected>Select a course</option>
                                        <?php foreach ($courses as $course): ?>
                                            <option value="<?php echo htmlspecialchars($course['id']); ?>">
                                                <?php echo htmlspecialchars($course['language_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">
                                        <i class="bi bi-book"></i> Lecture Title
                                    </label>
                                    <input type="text" class="form-control" id="title" 
                                           name="title" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="code" class="form-label">
                                        <i class="bi bi-code"></i> Lecture Code
                                    </label>
                                    <div class="code-editor">
                                        <textarea id="code" name="code" class="form-control" 
                                                  rows="10" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Create Lecture
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
