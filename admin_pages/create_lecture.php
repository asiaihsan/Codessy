<?php
require_once '../config.php';
require_once '../config.php';

if (!$session->isAdminLoggedIn()) {
    header("Location: ad123min_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $course = $_POST['course'];
    $title = $_POST['title'];
    $code = $_POST['code'];
    $adminID = $session->adminID;

    // Validate input
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
    <title>Codessy Admin - Create Lecture</title>
    <link rel="stylesheet" href="../css/admin_lecture.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <div class="admin-dashboard">
        <div class="lecture-form-container">
            <div class="lecture-form">
                <div class="lecture-form-header">
                    <h2>Create Lecture</h2>
                </div>

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

                <form action="create_lecture.php" method="POST" class="lecture-form">
                    <div class="form-group">
                        <label for="course"><i class="bi bi-code-slash"></i> Course:</label>
                        <select id="course" name="course" required class="form-control">
                            <option value="" disabled selected>Select a course</option>
                            <?php
                            $courses = $pdo->query("SELECT * FROM programing_language");
                            foreach ($courses as $course) {
                                echo "<option value='" . htmlspecialchars($course['id']) . "'>" . htmlspecialchars($course['language_name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title"><i class="bi bi-book"></i> Lecture Title:</label>
                        <input type="text" id="title" name="title" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="code"><i class="bi bi-code"></i> Lecture Code:</label>
                        <textarea id="code" name="code" required class="form-control code-editor"></textarea>
                    </div>

                    <button type="submit" name="submit" class="submit-button">
                        <i class="bi bi-save"></i> Create Lecture
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
