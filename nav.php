<?php
require_once 'config.php';

if (isset($_GET['language_id'])) {
    $_GET['language_id'] = htmlspecialchars($_GET['language_id']);
} else {
    $_GET['language_id'] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/nav.css">
    
    <title>Navigation_top</title>
</head>
<body class="body">
    <nav class="navbar navbar-php navbar-expand-lg fixed-top w-100">
        <div class="container">
            <a class="navbar-brand navbar-brand-php" href="#">Codessy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav navbar-nav-php me-auto mb-2 mb-lg-0">
                    <?php
                    $result = $pdo->query("SELECT * FROM programing_language");
                    foreach ($result as $row) {
                        $isSpecial = in_array(strtolower($row['language_name']), ['html', 'css', 'javascript']);
                        $specialClass = $isSpecial ? 'special-link ' . strtolower($row['language_name']) : '';
                    ?>
                        <li class="nav-item nav-item-php">
                            <a class="nav-link-php nav-link <?php echo $specialClass; ?>" href="lectures.php?language_id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['language_name']); ?></a>
                        </li>
                    <?php } ?>
                    <li class="nav-item nav-item-php">
                        <a class="nav-link nav-link-php special-link quiz" href="quiz.php">Quizzes</a>
                    </li>
                </ul>
                <?php
                if (!isset($_SESSION['username'])) { ?>
                    <div class="d-flex gap-2" role="search">
                        <a href="login.php" class="btn btn-primary-php">Sign In</a>
                        <a href="sign_up.php" class="btn text-primary-php">Sign Up</a>
                    </div>
                <?php } else { ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle-php  dropdown-toggle rounded-pill" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-php dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item dropdown-item-php" href=""><?php echo htmlspecialchars($session->userID); ?></a></li>
                            <li><a class="dropdown-item dropdown-item-php" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item dropdown-item-php" href="user_dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item dropdown-item-php" href="?logout">Logout</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>
</body>
</html>
