<?php
require_once 'config.php';
require_once 'nav.php';
if(!$session->isLoggedIn){
    header("Location: login.php");
    exit();
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
    <h1>User Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($session->username); ?>!</p>
    <?php
    $sql = "SELECT lectures.lecture_title, completed_lectures.created_at AS completed_at,programing_language.language_name AS names  FROM lectures JOIN completed_lectures ON lectures.id = completed_lectures.lecture_id JOIN programing_language ON lectures.language_id = programing_language.id WHERE completed_lectures.user_id = '$session->userID' GROUP BY programing_language.language_name";
    $stmt = $pdo->query($sql);
    
    if($stmt->rowCount() > 0) { ?>
        <h2>Your Lecture Progress</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Language</th>
                    <th>Lectures Completed</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stmt as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['names']); ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No lectures completed yet.</p>
    <?php } ?>
 

    <?php


    $sql = "SELECT lectures.lecture_title, completed_lectures.created_at AS completed_at FROM lectures JOIN completed_lectures ON lectures.id = completed_lectures.lecture_id WHERE completed_lectures.user_id = '$session->userID'";
    $stmt = $pdo->query($sql);
    if($stmt->rowCount() > 0) { ?>

        <h2>Completed Lectures (<?php echo $stmt->rowCount(); ?>)</h2>
        <table class="table">
            <thead>
                <tr>

                    <th>Lecture Title</th>
                    <th>Completed At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stmt as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['lecture_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['completed_at']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No completed lectures found.</p>
    <?php } ?>


    <?php
    $sql = "SELECT quizzes.quiz_title, completed_quizzes.created_at AS completed_at FROM quizzes JOIN completed_quizzes ON quizzes.id = completed_quizzes.quiz_id WHERE completed_quizzes.user_id = '$session->userID'";
    $stmt = $pdo->query($sql);
    if($stmt->rowCount() > 0) { ?>
        <h2>Completed Quizzes (<?php echo $stmt->rowCount(); ?>)</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Quiz Title</th>
                    <th>Completed At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stmt as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['quiz_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['completed_at']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No completed quizzes found.</p>
    <?php } ?>
</body>
</html>
