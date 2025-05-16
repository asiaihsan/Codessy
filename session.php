<?php
class Session{
    public $username;
    public $isLoggedIn;

    public function __construct(){
        session_start();
        $this->Check_login();
    }

    public function login($username){
        $_SESSION['username'] = $username;
        $_SESSION['isLoggedIn'] = true;
        $this->username = $username;
        $this->isLoggedIn = true;
    }

    public function logout(){
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['isLoggedIn']);
        unset($this->username);
        unset($this->isLoggedIn);
    }

    private function Check_login(){
        if(isset($_SESSION['username']) && isset($_SESSION['isLoggedIn'])){
            $this->username = $_SESSION['username'];
            $this->isLoggedIn = true;
        } else {
            unset($this->username);
            unset($this->isLoggedIn);
        }
    }
}

$session = new Session();

?>