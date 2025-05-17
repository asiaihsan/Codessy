<?php
require_once '../config.php';

 echo $_SESSION['admin_name'];
   echo  $_SESSION['admin_password'] ;
  echo $pdo->adminID;
  echo $_SESSION['adminID'];

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
            GROUP_CONCAT(users.user_name) as completed_by
        FROM quizzes
        LEFT JOIN completed_quizzes ON quizzes.id = completed_quizzes.quiz_id
        LEFT JOIN users ON completed_quizzes.user_id = users.id
        WHERE quizzes.admin_id = " . $_SESSION['adminID'] . "
        GROUP BY quizzes.id, quizzes.quiz_title";

$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Quizzes Created by You</h2>

<?php foreach ($result as $row): ?>
    <div style='margin-bottom: 15px;'>
        <h3><?php echo htmlspecialchars($row['quiz_title']); ?></h3>
        <?php if (!empty($row['completed_by'])): ?>
            <span>Completed by: <?php echo htmlspecialchars($row['completed_by']); ?></span>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php
$sql = "SELECT 
            lectures.id AS lecture_id,
            lectures.lecture_title,
            GROUP_CONCAT(users.user_name) as completed_by
        FROM lectures
        LEFT JOIN completed_lectures ON lectures.id = completed_lectures.lecture_id
        LEFT JOIN users ON completed_lectures.user_id = users.id
        WHERE lectures.admin_id = " . $_SESSION['adminID'] . "
        GROUP BY lectures.id, lectures.lecture_title";

$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Lectures Created by You</h2>

<?php foreach ($result as $row): ?>
    <div style='margin-bottom: 15px;'>
        <h3><?php echo htmlspecialchars($row['lecture_title']); ?></h3>
        <?php if (!empty($row['completed_by'])): ?>
            <span>Completed by: <?php echo htmlspecialchars($row['completed_by']); ?></span>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</body>
</html>