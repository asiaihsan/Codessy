<?php
require_once '../config.php';

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
    <title>Codessy Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/admin_nav.css">
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="bi bi-shield-lock fs-1 me-2"></i>
                    Codessy Admin
                </div>
            </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="admin_dashbaord.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashbaord.php' ? 'active' : ''; ?>">
                        <i class="bi bi-grid-3x3-gap-fill"></i> Dashboard
                    </a>
                </li>
                <?php if(isset($_SESSION['adminID']) && $_SESSION['adminID']=== 1): ?>
                <li class="nav-item">
                    <a href="add_admin.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'add_admin.php' ? 'active' : ''; ?>">
                        <i class="bi bi-person-plus-fill"></i> Add Admin
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="admin_profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'admin_profile.php' ? 'active' : ''; ?>">
                        <i class="bi bi-person-circle"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="create_lecture.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'create_lecture.php' ? 'active' : ''; ?>">
                        <i class="bi bi-camera-reels-fill"></i> Create Lecture
                    </a>
                </li>
                <li class="nav-item">
                    <a href="create_quiz.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'create_quiz.php' ? 'active' : ''; ?>">
                        <i class="bi bi-question-circle-fill"></i> Create Quiz
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?admin_logout" class="nav-link">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>