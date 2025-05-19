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
    <style>
        body {
            margin: 0;
            padding: 0;
            padding-top: 80px; /* Offset for fixed navbar */
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8f4e6;
            color: #181818;
            overflow-x: hidden;
            width: 100%;
            box-sizing: border-box;
        }

        .navbar {
            background: #f8f4e6 !important;
            padding: 0.5rem 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            width: 100% !important;
        }

        .container-fluid {
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .navbar-brand {
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.6rem;
            font-weight: bold;
            background: #d2e07a;
            padding: 0.2em 0.7em;
            border-radius: 4px;
            letter-spacing: 2px;
            color: #181818 !important;
        }

        .nav-link {
            color: #181818 !important;
            font-weight: 500;
            padding: 0.5em 1em !important;
            border-radius: 4px;
            transition: all 0.3s ease;
            margin: 0 0.2em;
        }

        .nav-link:hover {
            background: rgba(210, 224, 122, 0.2);
        }

        .nav-link.special-link {
            color: #181818 !important;
            font-weight: 600;
            background: rgba(210, 224, 122, 0.2);
            transition: all 0.3s ease;
        }

        .nav-link.special-link:hover {
            background: rgba(210, 224, 122, 0.4);
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            padding: 0;
            flex-wrap: nowrap;
        }

        .nav-item {
            display: flex;
            align-items: center;
        }

        .btn-primary {
            background: #d2e07a !important;
            color: #181818 !important;
            font-weight: bold;
            border: none !important;
            transition: all 0.32s cubic-bezier(.22, 1.61, .36, 1);
        }

        .btn-primary:hover {
            background: #b6c95a !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn.text-primary {
            color: #181818 !important;
            font-weight: 500;
            transition: all 0.32s cubic-bezier(.22, 1.61, .36, 1);
        }

        .btn.text-primary:hover {
            transform: translateY(-2px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            background: #f8f4e6;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #181818;
            transition: all 0.32s cubic-bezier(.22, 1.61, .36, 1);
            padding: 0.5rem 1rem;
        }

        .dropdown-item:hover {
            background: #d2e07a;
            transform: translateX(4px);
        }

        .btn-secondary {
            background: #d2e07a !important;
            color: #181818 !important;
            border: none !important;
            transition: all 0.32s cubic-bezier(.22, 1.61, .36, 1);
        }

        .btn-secondary:hover {
            background: #b6c95a !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dropdown-toggle::after {
            transition: transform 0.32s cubic-bezier(.22, 1.61, .36, 1);
        }

        .dropdown.show .dropdown-toggle::after {
            transform: rotate(180deg);
        }
    </style>
    <title>Navigation_top</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top w-100">
        <div class="container">
            <a class="navbar-brand" href="#">Codessy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    $result = $pdo->query("SELECT * FROM programing_language");
                    foreach ($result as $row) {
                        $isSpecial = in_array(strtolower($row['language_name']), ['html', 'css', 'javascript']);
                        $specialClass = $isSpecial ? 'special-link ' . strtolower($row['language_name']) : '';
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $specialClass; ?>" href="lectures.php?language_id=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['language_name']); ?></a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link special-link quiz" href="quiz.php?language_id=<?php echo htmlspecialchars($row['id']); ?>">Quizzes</a>
                    </li>
                </ul>
                <?php
                if (!isset($_SESSION['username'])) { ?>
                    <div class="d-flex gap-2" role="search">
                        <a href="login.php" class="btn btn-primary">Sign In</a>
                        <a href="sign_up.php" class="btn text-primary">Sign Up</a>
                    </div>
                <?php } else { ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle rounded-pill" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href=""><?php echo htmlspecialchars($session->userID); ?></a></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="user_dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item" href="?logout">Logout</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>
</body>
</html>
