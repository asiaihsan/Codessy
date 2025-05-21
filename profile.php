<?php
require_once 'config.php';
require_once 'nav.php';

if (!$session->isLoggedIn && !isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

// Validation
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_valid_username($username) {
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
}

function is_valid_password($password) {
    return strlen($password) >= 6;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'All fields are required!';
    } elseif (!is_valid_username($username)) {
        $_SESSION['error'] = 'Invalid username! Only letters, numbers, and underscores (3-20 chars).';
    } elseif (!is_valid_email($email)) {
        $_SESSION['error'] = 'Invalid email format!';
    } elseif (!is_valid_password($password)) {
        $_SESSION['error'] = 'Password must be at least 6 characters!';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->query("UPDATE users SET user_name = '$username', user_email = '$email', user_password = '$hashedPassword' WHERE id = '$session->userID'");
        if ($stmt) {
            $_SESSION['success'] = 'Profile updated successfully!';
            header("Location: profile.php");
            exit();
        } else {
            $_SESSION['error'] = 'Error updating profile!';
        }
    }
    header("Location: profile.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_profile'])) {
    $stmt = $pdo->query("DELETE FROM users WHERE id = '$session->userID'");
    if($stmt) {
        session_destroy();
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
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']);
            }   
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['success']) . '</div>';
                unset($_SESSION['success']);
            }
            ?>
           
            <form action="profile.php" method="POST">
                <?php
                $stmt = $pdo->query("SELECT * FROM users WHERE id = '$session->userID'");

                foreach ($stmt as $row) {
                    // Display message if exists

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