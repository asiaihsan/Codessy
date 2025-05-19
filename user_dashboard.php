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
    <link rel="stylesheet" href="css/user_dashboard.css">
    <title>User Dashboard - Codessy</title>
</head>
<body class="body-dashboard">
    <div class="container-dashboard">
        <div class="dashboard-header">
            <h1>User Dashboard</h1>
            <p class="welcome-text">Welcome, <?php echo htmlspecialchars($session->username); ?>!</p>
        </div>

        <div class="dashboard-content">
            <?php
            $sql = "SELECT lectures.lecture_title, completed_lectures.created_at AS completed_at,programing_language.language_name AS names  FROM lectures JOIN completed_lectures ON lectures.id = completed_lectures.lecture_id JOIN programing_language ON lectures.language_id = programing_language.id WHERE completed_lectures.user_id = '$session->userID' GROUP BY programing_language.language_name";
            $stmt = $pdo->query($sql);
            
            if($stmt->rowCount() > 0) { ?>
                <div class="dashboard-section">
                    <h2>Your Languages</h2>
                    <ul class="language-list">
                        <?php foreach ($stmt as $row) { ?>
                            <li class="language-item"><?php echo htmlspecialchars($row['names']); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } else { ?>
                <p class="no-data">No lectures completed yet.</p>
            <?php } ?>

            <?php
            $sql = "SELECT lectures.lecture_title, completed_lectures.created_at AS completed_at FROM lectures JOIN completed_lectures ON lectures.id = completed_lectures.lecture_id WHERE completed_lectures.user_id = '$session->userID'";
            $stmt = $pdo->query($sql);
            if($stmt->rowCount() > 0) { ?>
                <div class="dashboard-section">
                    <h2>Completed Lectures (<?php echo $stmt->rowCount(); ?>)</h2>
                    <div class="table-responsive">
                        <table class="table table-dashboard">
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
                    </div>
                </div>
            <?php } else { ?>
                <p class="no-data">No completed lectures found.</p>
            <?php } ?>

            <?php
            $sql = "SELECT quizzes.quiz_title, completed_quizzes.created_at AS completed_at FROM quizzes JOIN completed_quizzes ON quizzes.id = completed_quizzes.quiz_id WHERE completed_quizzes.user_id = '$session->userID'";
            $stmt = $pdo->query($sql);
            if($stmt->rowCount() > 0) { ?>
                <div class="dashboard-section">
                    <h2>Completed Quizzes (<?php echo $stmt->rowCount(); ?>)</h2>
                    <div class="table-responsive">
                        <table class="table table-dashboard">
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
                    </div>
                </div>
            <?php } else { ?>
                <p class="no-data">No completed quizzes found.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>
