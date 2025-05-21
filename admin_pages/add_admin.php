<?php
require_once '../config.php';
require_once 'admin_nav.php';

// Security check - only super admin (ID 1) can access
if (!$session->isAdminLoggedIn() || !isset($_SESSION['adminID']) || $_SESSION['adminID'] !== 1) {
    header("Location: admin_login.php");
    exit();
}

// Handle admin addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

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

// Get all admins for display
$stmt = $pdo->query("SELECT * FROM admins");
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Codessy Admin - Manage Admins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/add_admin.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-people"></i> Manage Admins
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

                        <!-- Add Admin Form -->
                        <div class="mb-4">
                            <h6 class="mb-3"><i class="bi bi-person-plus"></i> Add New Admin</h6>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label">
                                            <i class="bi bi-person"></i> Username
                                        </label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-lock"></i> Password
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" name="submit" class="btn btn-primary">
                                            <i class="bi bi-save"></i> Add Admin
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Admins List -->
                        <h6 class="mb-3"><i class="bi bi-people"></i> Admins List</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($admins as $admin): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($admin['id']); ?></td>
                                            <td><?php echo htmlspecialchars($admin['admin_name']); ?></td>
                                            <td><?php echo htmlspecialchars($admin['created_at']); ?></td>
                                            <td>
                                                <a href="edit_admin.php?id=<?php echo $admin['id']; ?>" 
                                                   class="btn btn-sm btn-primary me-2">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="delete_admin.php" method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                                    <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>