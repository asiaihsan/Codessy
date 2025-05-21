<?php
require_once 'config.php';

$error = '';

// Additional validation function
function validate_login_input($username, $password) {
    if (strlen($username) < 3 || strlen($username) > 32) {
        return "Username must be between 3 and 32 characters.";
    }
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        return "Username can only contain letters, numbers, and underscores.";
    }
    if (strlen($password) < 6) {
        return "Password must be at least 6 characters.";
    }
    return '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($username) || empty($password)) {
        $error = "Both username and password are required.";
    } else {
        // Additional validation
        $validationError = validate_login_input($username, $password);
        if ($validationError !== '') {
            $error = $validationError;
        } else {
            if ($pdo->login($username, $password)) {
                $session->userID = $pdo->userID;
                $session->login($username, $password);
                
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Codessy</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body class="body-login">
    <div class="login-container">
        <div class="login-header">
            <h1>Login to Codessy</h1>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="login-button">Login</button>
        </form>

        <div class="login-footer">
            <p>Don't have an account? <a href="sign_up.php">Sign up</a></p>
        </div>
    </div>
</body>
</html>