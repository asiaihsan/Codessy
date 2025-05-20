<?php
require_once '../config.php';
require_once 'admin_nav.php';

if (!$session->isAdminLoggedIn()) {
    header("Location: ad123min_login.php");
    exit();
}

// Get current admin data
$stmt = $pdo->query("SELECT admin_name, admin_password FROM admins WHERE id = '$session->adminID'");
$admin = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "UPDATE admins SET admin_name = '$username', admin_password = '$hashedPassword' WHERE id = '$session->adminID'";
        $stmt = $pdo->query($sql);
        
        
        if ($stmt) {
            $_SESSION['success'] = "Profile updated successfully.";
            header("Location: admin_profile.php");
            exit();
        } else {
            $_SESSION['error'] = "Error updating profile.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_profile'])) {
    $stmt = $pdo->query("DELETE FROM admins WHERE id = '$session->adminID'");
    if($stmt) {
        header("Location: admin_login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error deleting profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Profile</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($admin['admin_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter new password" required>
            </div>

            <div class="mb-3">
                <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                <button type="submit" name="delete_profile" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your profile?')">Delete Profile</button>
            </div>
        </form>
    </div>
</body>
</html>
