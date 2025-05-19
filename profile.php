<?php
require_once 'config.php';
require_once 'nav.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($username) || empty($email) || empty($password)) {
        echo '<div class="alert alert-danger">All fields are required!</div>';
        
    }else{

    $stmt = $pdo->query("UPDATE users SET user_name = '$username', user_email = '$email', user_password = '$password' WHERE id = '$session->userID'");
    if($stmt) {
       header("Location: profile.php");
       exit();
    } else {
        echo '<div class="alert alert-danger">Error updating profile!</div>';
       
    }

    // Update user profile in the database

    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_profile'])) {
    $stmt = $pdo->query("DELETE FROM users WHERE id = '$session->userID'");
    if($stmt) {
        header("Location: login.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Error deleting profile!</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile - Codessy</title>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>Profile Settings</h1>
            <p>Manage your account information</p>
        </div>

        <div class="profile-form">
            <form action="profile.php" method="POST">
                <?php
                $stmt = $pdo->query("SELECT * FROM users WHERE id = '$session->userID'");
                foreach ($stmt as $row) {
                    ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($row['user_name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['user_email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($row['user_password']); ?>">
                    </div>
                    <?php 
                }
                ?>
                <div class="btn-group">
                    <button type="submit" name="update_profile" class="btn-profile btn-update">Update Profile</button>
                    <button type="submit" name="delete_profile" class="btn-profile btn-delete">Delete Profile</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>