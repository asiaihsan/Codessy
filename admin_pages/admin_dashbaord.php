<?php
require_once '../config.php';
require_once 'admin_nav.php';
if (!$session->isAdminLoggedIn()) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Codessy</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .table-container {
            overflow-x: auto;
        }
        .code-cell {
            max-width: 200px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            padding: 0.5rem;
            background: rgba(37, 99, 235, 0.05);
            border-radius: 0.375rem;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 0.875rem;
            line-height: 1.4;
        }
        .code-cell pre {
            margin: 0;
            padding: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            max-height: 2.5rem;
            line-height: 1.25;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="welcome-message">
                <i class="fas fa-user-shield"></i> Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!
            </div>
            <div class="admin-id">
                <i class="fas fa-id-badge"></i> Admin ID: <?php echo htmlspecialchars($_SESSION['adminID']); ?>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stat-grid">
            <!-- Users Stat -->
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-number"><?php 
                    $totalUsers = $pdo->query("SELECT COUNT(*) as total FROM users")->fetch(PDO::FETCH_ASSOC)['total'];
                    echo $totalUsers;
                ?></div>
                <div class="stat-label">Total Users</div>
            </div>

            <!-- Quizzes Stat -->
            <div class="stat-card">
                <i class="fas fa-question-circle"></i>
                <div class="stat-number"><?php 
                    $totalQuizzes = $pdo->query("SELECT COUNT(*) as total FROM quizzes WHERE admin_id = " . $_SESSION['adminID'])->fetch(PDO::FETCH_ASSOC)['total'];
                    echo $totalQuizzes;
                ?></div>
                <div class="stat-label">Your Quizzes</div>
            </div>

            <!-- Lectures Stat -->
            <div class="stat-card">
                <i class="fas fa-book"></i>
                <div class="stat-number"><?php 
                    $totalLectures = $pdo->query("SELECT COUNT(*) as total FROM lectures WHERE admin_id = " . $_SESSION['adminID'])->fetch(PDO::FETCH_ASSOC)['total'];
                    echo $totalLectures;
                ?></div>
                <div class="stat-label">Your Lectures</div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="create_quiz.php" class="create-btn">
                <i class="fas fa-plus"></i> Create New Quiz
            </a>
            <a href="create_lecture.php" class="create-btn">
                <i class="fas fa-plus"></i> Create New Lecture
            </a>
        </div>

        <!-- Users Section -->
        <div class="section-header">
            <h2><i class="fas fa-users"></i> Users List</h2>
        </div>
        
        <?php 
        $sql = "SELECT * FROM users ORDER BY user_name ASC";
        $stmt = $pdo->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['user_email']); ?></td>
                            <td><?php echo htmlspecialchars($user['user_password']); ?></td>
                            <td><?php echo htmlspecialchars(date('M d, Y', strtotime($user['created_at']))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Quizzes Section -->
        <div class="section-header">
            <h2><i class="fas fa-question-circle"></i> Your Quizzes</h2>
        </div>
        
        <?php
        $sql = "SELECT * FROM quizzes WHERE admin_id = " . $_SESSION['adminID'] . " ORDER BY created_at DESC";
        $stmt = $pdo->query($sql);
        $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Code</th>
                        <th>Answer</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($quizzes as $quiz): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($quiz['id']); ?></td>
                            <td><?php echo htmlspecialchars($quiz['quiz_title']); ?></td>
                            <td><?php echo htmlspecialchars($quiz['quiz_content']); ?></td>
                            <td class="code-cell">
                                <pre><?php echo htmlspecialchars($quiz['quiz_code']); ?></pre>
                            </td>
                            <td><?php echo htmlspecialchars($quiz['quiz_answer']); ?></td>
                            <td><?php echo htmlspecialchars(date('M d, Y', strtotime($quiz['created_at']))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Lectures Section -->
        <div class="section-header">
            <h2><i class="fas fa-book"></i> Your Lectures</h2>
        </div>
        
        <?php
        $sql = "SELECT * FROM lectures WHERE admin_id = " . $_SESSION['adminID'] . " ORDER BY created_at DESC";
        $stmt = $pdo->query($sql);
        $lectures = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Code</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lectures as $lecture): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lecture['id']); ?></td>
                            <td><?php echo htmlspecialchars($lecture['lecture_title']); ?></td>
                            <td class="code-cell">
                                <pre><?php echo htmlspecialchars($lecture['lecture_code']); ?></pre>
                            </td>
                            <td><?php echo htmlspecialchars(date('M d, Y', strtotime($lecture['created_at']))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>