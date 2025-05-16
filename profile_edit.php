<?php
require_once 'config.php';
require_once 'session.php';
class Edit{

public function updateProfile($user_id, $username, $email, $password) {
    global $pdo;
    $stmt = $pdo->query("UPDATE users SET user_name = '$username', user_email = '$email', user_password = '$password' WHERE id = '$user_id'");
    }
}
$edit = new Edit();

?>