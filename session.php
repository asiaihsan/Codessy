<?php
class Session{
    public $username;
    public $password;
    public $userID;
    public $isLoggedIn;

    public  $admin_name;
    public $admin_password;
    public $adminID;
    public $isAdminLoggedIn;

    public function __construct(){
        session_start();
        $this->Check_login();
    }


    public function adminSession($name, $password){
        $_SESSION['admin_name'] = $name;
        $_SESSION['admin_password'] = $password;
        $_SESSION['adminID'] = $this->adminID;
        $_SESSION['isAdminLoggedIn'] = true;
        $this->admin_name = $name;
        $this->isAdminLoggedIn = true;
    }
    public function isAdminLoggedIn(){
        if(isset($_SESSION['admin_name']) && isset($_SESSION['admin_password'])){
            $this->admin_name = $_SESSION['admin_name'];
            $this->admin_password = $_SESSION['admin_password'];
            $this->adminID = $_SESSION['adminID'];
            $this->isAdminLoggedIn = true;
            return true;
        } else {
            unset($this->admin_name);
            unset($this->admin_password);
            unset($this->adminID);
            unset($this->isAdminLoggedIn);
            return false;
        }
    }
    public function adminLogout(){
        session_destroy();
        unset($_SESSION['admin_name']);
        unset($_SESSION['adminID']);
        unset($_SESSION['admin_password']);
        unset($this->admin_name);
        unset($this->adminID);
        unset($this->admin_password);
        unset($this->isAdminLoggedIn);
    }


    public function login($username, $password){
        $_SESSION['password'] = $password;
        $_SESSION['username'] = $username;
        $_SESSION['userID'] = $this->userID;
        $_SESSION['isLoggedIn'] = true;
        $this->username = $username;
        $this->password = $password;
        $this->isLoggedIn = true;
    }

    public function logout(){
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['userID']);
        unset($_SESSION['isLoggedIn']);
        unset($this->username);
        unset($this->userID);
        unset($this->password);
        unset($this->isLoggedIn);
    }

    private function Check_login(){
        if(isset($_SESSION['username']) && isset($_SESSION['isLoggedIn'])){
            $this->username = $_SESSION['username'];
            $this->password = $_SESSION['password'];
            $this->userID = $_SESSION['userID'];
            $this->isLoggedIn = true;
        } else {
            unset($this->username);
            unset($this->password);
            unset($this->userID);
            unset($this->isLoggedIn);
        }
    }
}

$session = new Session();

?>