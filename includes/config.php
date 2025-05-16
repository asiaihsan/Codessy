<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'w3schools_clone');

class Database {
    private $pdo;

    public function __construct() {
        try{
            $this->pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

    public function query($sql){
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
      public function secure($data){
        return $this->pdo->quote(htmlspecialchars($data));
    }

    public function signUp($username, $password, $email){
        $username = $this->secure($username);
        $password = $this->secure($password);
        $email = $this->secure($email);
        $sql = "INSERT INTO users (user_name, user_password, user_email, created_at) VALUES (:username, :password, :email, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
    public function login($username, $password){
        $username = $this->secure($username);
        $password = $this->secure($password);
        $sql = "SELECT * FROM users WHERE user_name = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password, $user['user_password'])){
            return true;
        }
        return false;
    }
}

$pdo = new Database();
?>