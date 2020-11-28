<?php

require_once '../services/dbconnection.php';
require_once '../services/cf.php';
require_once '../config.php';

class Login
{
    private $email;
    private $password;

    function __construct(){
        $this->SetEmail($_POST['email_login']);
        $this->SetPassword($_POST['password_login']);
        $this->authenticate();
    }

    public function SetEmail($userEmail){
        $this->email = LC($userEmail);
    }

    public function SetPassword($userPassword){
        $this->password = LC($userPassword);
    }

    public function authenticate(){
        global $connection;
        global $SALT_KEY;
        $new_password = md5($this->password.$SALT_KEY);
        $query = "SELECT * FROM usuario WHERE email_usu = '$this->email' AND senha_usu = '$new_password'";
        $query_answer = mysqli_query($connection ,$query);
        $userdata = mysqli_fetch_array($query_answer);
        if(empty($userdata)){
            $_SESSION['message'] = "Incorrect email or password";
            header('Location: ../login.php');
        }else{
            $_SESSION['user_data'] = $userdata;
            $_SESSION['message'] = "Welcome, ".$_SESSION['user_data']['nome_usu'];
            header('Location: ../home.php');
        }
    }
}


if(!isset($_POST['btn_login'])){
    $_SESSION['message'] = "Invalid action";
    header("Location: ../index.php");
}else{
    if(empty($_POST['email_login']) || empty($_POST['password_login'])){
        $_SESSION['message'] = "All fields must be filled in";
        header("Location: ../login.php");
    }else{
        $user = new Login();
    }
}
?>