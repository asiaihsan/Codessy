<?php
require_once '../config.php';
require_once 'admin_nav.php';

if (!$session->isAdminLoggedIn()) {
    header("Location: admin_login.php");
    exit();
}

// Get current admin data
$stmt = $pdo->query("SELECT admin_name, admin_password FROM admins WHERE id = '$session->adminID'");
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
    } else {
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

// Handle profile deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_profile'])) {
    $stmt = $pdo->query("DELETE FROM admins WHERE id = '$session->adminID'");
    if ($stmt) {
        header("Location: admin_login.php");
        exit();
    } else {
        $_SESSION['error'] = "Error deleting profile.";
    }
}

// Handle session messages
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codessy Admin - Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_profile.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-person-circle"></i> Admin Profile
                        </h5>
                        <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- Success/Error Messages -->
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <!-- Profile Form -->
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">
                                        <i class="bi bi-person"></i> Username
                                    </label>
                                    <input type="text" class="form-control" id="username" 
                                           name="username" value="<?php echo htmlspecialchars($admin['admin_name']); ?>" 
                                           required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-lock"></i> Password
                                    </label>
                                    <input type="password" class="form-control" id="password" 
                                           name="password" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <button type="submit" name="update_profile" class="btn btn-primary me-2">
                                        <i class="bi bi-save"></i> Update Profile
                                    </button>
                                    <button type="submit" name="delete_profile" class="btn btn-danger" 
                                            onclick="return confirm('Are you sure you want to delete your profile?')">
                                        <i class="bi bi-trash"></i> Delete Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
