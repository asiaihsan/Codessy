<?php
class Session{

    public $email;
    public $password;

    public function __construct(){
        session_start();
        $this->Check_login();
    }


    public function login($email, $password){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

    }


    public function logout(){
        session_destroy();
        // setcookie(session_name(), '', time() - 3600, '/');
        unset( $_SESSION['email']);
        unset( $_SESSION['password']);
        unset($this->password);
        unset($this->email);
    }


    private function Check_login(){
        if(isset($_SESSION['email']) && isset($_SESSION['password'])){
            $this->email= $_SESSION['email'];
            $this->password= $_SESSION['password'];
        }else{
            unset($this->password);
            unset($this->email);
        }
    }

}


$session = new Session();

?>