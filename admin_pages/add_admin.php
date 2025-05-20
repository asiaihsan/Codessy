<?php
require_once '../config.php';

require_once 'admin_nav.php';

if (!$session->isAdminLoggedIn() && !isset($_SESSION['adminID'])) {
    header("Location: ad123min_login.php");
    exit();
}
if(!isset($_SESSION['adminID']) && !$_SESSION['adminID'] === 1){
 header("Location: ad123min_login.php");
 exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO `admins` (`admin_name`, `admin_password`, `created_at`) VALUES ('$username', '$hashedPassword', NOW())";
        $stmt = $pdo->query($sql);
        if ($stmt) {
            $_SESSION['success'] = "Admin added successfully.";
            header("Location: add_admin.php");
            exit();
        } else {
            $_SESSION['error'] = "Error adding admin.";
        }
    }
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
  

<div class="container">
    <form action="add_admin.php" method="POST">
        <h2>Add Admin</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input name="submit" type="submit" value="Add Admin">
    </form>
</div>



<?php 
$sql = "SELECT * FROM `admins`";
$stmt = $pdo->query($sql);

if($stmt->rowCount() > 0) { ?>
    <h2>Admins List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stmt as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['admin_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['admin_password']); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <p>No admins found.</p>
<?php } ?>
    
</body>
</html>