<?php
require_once 'session.php';
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'codessy');

class Database {
    private $pdo;
    public $adminID;
    public $userID;
    public $user_email;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

    public function query($sql) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function secure($data) {
        return htmlspecialchars(trim($data));
    }

    public function signUp($username, $password, $email) {
        try {
            // Check if username or email already exists
            $check = $this->pdo->prepare("SELECT * FROM users WHERE user_name = ? OR user_email = ?");
            $check->execute([$username, $email]);
            if($check->rowCount() > 0) {
                return false;
            }
            
            $sql = "INSERT INTO users (user_name, user_password, user_email, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$username, $password, $email]);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function login($username, $password) {
        try {
            $check = $this->pdo->prepare("SELECT * FROM users WHERE user_name = ? OR user_email = ?");
            $check->execute([$username, $password]);
            if($check->rowCount() > 0) {
                $user = $check->fetch(PDO::FETCH_ASSOC);
                $this->userID = $user['id'];
                $this->user_email = $user['user_email'];
                return true;
            }else{
                return false;
            }
        } catch(PDOException $e) {
            return false;
        }
    }

    public function adminLogin($username, $password) {
        try {
            $sql = "SELECT * FROM admins WHERE admin_name = ? AND admin_password = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$username, $password]);
            if($stmt->rowCount() > 0) {
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->adminID = $admin['id'];
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            return false;
        }
    }
}

$pdo = new Database();


if(isset($_GET['logout'])) {
    session_start();
    session_destroy();
    header("Location:login.php");
    exit();
}
?>