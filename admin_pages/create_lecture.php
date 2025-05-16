<?php
require_once '../config.php';
if (!$session->isAdminLoggedIn()) {
    header("Location: ../index.php");
    exit();
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
        <input type="submit" value="Create Lecture">
    </form>
</body>
</html>