<?php

require_once '../config.php';
if (!$session->isAdminLoggedIn()) {
    header("Location:ad123min_login.php");
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
    <title>Create Lecture</title>
</head>
<body>
    <h1>Create Lecture</h1>
    <form action="create_lecture.php" method="POST">

        <label for="course">Course:</label>
        <select id="course" name="course" required>
            <?php
            $courses = $pdo->query("SELECT * FROM programing_language");
            echo "<option value='' disabled selected>Select a course</option>";
            foreach ($courses as $course) {
                echo "<option value='" . htmlspecialchars($course['id']) . "'>" . htmlspecialchars($course['language_name']) . "</option>";
            }

           
            ?>
        </select>
        <br>
        <label for="title">Lecture Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="code">Lecture Code:</label>
        <textarea id="code" name="code" required></textarea>
        <br>
        <input name="submit" type="submit" value="Create Lecture">
    </form>
</body>
</html>



<?php
echo $session->adminID;
?>