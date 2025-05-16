<?php
require_once 'config.php';
require_once 'nav.php';

if(isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $edit->updateProfile($session->user_id, $username, $email, $password);
    if($edit) {
        echo "Profile updated successfully.";
    } else {
        echo "Failed to update profile.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1><?php echo htmlspecialchars($session->username); ?>'s Profile</h1>
<p>Username: <?php echo htmlspecialchars($session->userID); ?></p>

<p>Welcome to your profile page!</p>
<form action="profile_edit.php" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($session->username); ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($session->user_email); ?>">
    </div>
    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
</form>


</body>
</html>