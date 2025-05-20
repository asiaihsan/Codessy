<?php
require_once '../config.php';
require_once 'admin_nav.php';
if (!$session->isAdminLoggedIn()) {
    header("Location: ad123min_login.php");
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
  <h1>Admin Dashboard</h1>
  <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>
  <p>Your ID: <?php echo htmlspecialchars($_SESSION['adminID']); ?></p>
  <p><a href="create_quiz.php">Create Quiz</a></p>
  <p><a href="create_lecture.php">Create Lecture</a></p>
  <p><a href="?admin_logout">Logout</a></p>


  <?php 
  $sql = "SELECT * FROM users";
  $stmt = $pdo->query($sql);
  if($stmt->rowCount() > 0) { ?>
    <h2>Users List</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($stmt as $row) { ?>
          <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
            <td><?php echo htmlspecialchars($row['user_email']); ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p>No users found.</p>
  <?php } ?>

<?php


$sql = "SELECT 
            quizzes.id AS quiz_id,
            quizzes.quiz_title,
            quizzes.quiz_content,
            quizzes.quiz_code,
            quizzes.quiz_answer,
            quizzes.created_at,
            GROUP_CONCAT(users.user_name) as completed_by
        FROM quizzes
        LEFT JOIN completed_quizzes ON quizzes.id = completed_quizzes.quiz_id
        LEFT JOIN users ON completed_quizzes.user_id = users.id
        WHERE quizzes.admin_id = " . $_SESSION['adminID'] . "
        GROUP BY quizzes.id, quizzes.quiz_title";

$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Quizzes Created by You (<?php echo count($result); ?>)</h2>

<?php foreach ($result as $row): ?>
    <div style='margin-bottom: 15px;'>
        <h3><?php echo htmlspecialchars($row['quiz_title']); ?></h3>
        <p><?php echo htmlspecialchars($row['quiz_content']); ?></p>
        <p><?php echo htmlspecialchars($row['quiz_code']); ?></p>
        <p><?php echo htmlspecialchars($row['quiz_answer']); ?></p>
        <p><?php echo htmlspecialchars($row['created_at']); ?></p>
        <?php if (!empty($row['completed_by'])): ?>
            <span>Completed by: <?php echo htmlspecialchars($row['completed_by']); ?></span>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php
$sql = "SELECT 
            lectures.id AS lecture_id,
            lectures.lecture_title,
            lectures.lecture_code,
            lectures.created_at,
            GROUP_CONCAT(users.user_name) as completed_by
        FROM lectures
        LEFT JOIN completed_lectures ON lectures.id = completed_lectures.lecture_id
        LEFT JOIN users ON completed_lectures.user_id = users.id
        WHERE lectures.admin_id = " . $_SESSION['adminID'] . "
        GROUP BY lectures.id, lectures.lecture_title";

$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Lectures Created by You (<?php echo count($result); ?>)</h2>

<?php foreach ($result as $row): ?>
    <div style='margin-bottom: 15px;'>
        <h3><?php echo htmlspecialchars($row['lecture_title']); ?></h3>
        <p><?php echo htmlspecialchars($row['lecture_code']); ?></p>
        <p><?php echo htmlspecialchars($row['created_at']); ?></p>
        <?php if (!empty($row['completed_by'])): ?>
            <span>Completed by: <?php echo htmlspecialchars($row['completed_by']); ?></span>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</body>
</html>