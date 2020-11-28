<?php

require_once '../services/dbconnection.php';
require_once '../services/cf.php';
require_once '../config.php';
require_once '../services/generator.php';

class Signup
{

    private $name;
    private $email;
    private $password;
    private $checked;

    function __construct(){
        $this->setName($_POST['name_signup']);
        $this->setEmail($_POST['email_signup']);
        $this->setPassword($_POST['password_signup']);
        $this->checkEmail();
        $this->createUser();
    }

    public function setName($field){
        $this->name = LC($field);
    }

    public function setEmail($field){
        $this->email = LC($field);
    }

    public function setPassword($field){
        $this->password = LC($field);
    }

    public function checkEmail(){
        global $connection;
        $query = "SELECT * FROM usuario WHERE email_usu = '$this->email'";
        $answer_query = mysqli_query($connection, $query);
        $userdata = mysqli_fetch_array($answer_query);
        if (!empty($userdata)) {
            $this->checked = 1;
        }else{
            $this->checked = 0;
        }
    }

    public function createUser(){
        global $connection;
        global $SALT_KEY;
        if (!$this->checked == 1) {
            $cd_library = gerar();
            $query = "INSERT INTO biblioteca (cd_biblioteca) VALUES ('$cd_library')";
            if(mysqli_query($connection, $query)){
                $cd_usu = gerar();
                $new_password = md5($this->password.$SALT_KEY);
                $query = "INSERT INTO usuario (cd_usu, nome_usu, email_usu , senha_usu, saldo_usu, cd_biblioteca) VALUES ('$cd_usu', '$this->name', '$this->email', '$new_password', 0, '$cd_library')";
                if(mysqli_query($connection, $query)){
                    $_SESSION['message'] = "Successfully registered";
                    header('Location: ../login.php');
                }else{
                    $_SESSION['message'] = "Something go wrong";
                    header('Location: ../signup.php');
                }
            }else{
                $_SESSION['message'] = "Something go wrong";
                header('Location: ../signup.php');
            }
        }else{
            $_SESSION['message'] = "This email is already registred";
            header('Location: ../signup.php');
        }   
    }  
}

if(!isset($_POST['btn_signup'])){
    $_SESSION['message'] = "Invalid action";
    header("Location: ../index.php");
}else{
    if(empty($_POST['name_signup']) || empty($_POST['email_signup']) || empty($_POST['password_signup'])){
        $_SESSION['message'] = "All fields must be filled in";
        header("Location: ../signup.php");
    }else{
        $newUser = new Signup();
    }
}
?>