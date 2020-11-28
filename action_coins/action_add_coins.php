<?php
require_once '../services/dbconnection.php';
require_once '../services/cf.php';
?>
<?php
class Coins
{
    private $coins;
    private $cd_user;

    function __construct(){
        $this->checkCoins($_POST['coins_number']);
    }

    private function checkCoins($number){
        $number = LC($number);
        $number = (double) $number;
        if ($number <= 0) {
            $_SESSION['message'] = "Invalid value";
            header('Location: ../add_coins.php');
        }else{
            $this->setCoins($number);
            $this->setUser();
        }
    }

    private function setCoins($ncoins){
        $this->coins = $ncoins;
    }

    private function setUser(){
        $this->cd_user = $_SESSION['user_data']['cd_usu'];
        $this->updateCoins();
    }

    private function updateCoins(){
        global $connection;
        $t = $_SESSION['user_data']['saldo_usu'];
        $this->coins += $t;
        $query = "UPDATE usuario SET saldo_usu = $this->coins WHERE cd_usu = '$this->cd_user'";
        if(mysqli_query($connection, $query)){
            $_SESSION['user_data']['saldo_usu'] = $this->coins;
            $_SESSION['message'] = "Successfully added";
            header('Location: ../home.php');
        }else{
            $_SESSION['message'] = "Something go wrong";
            header('Location: ../home.php');
        }
    }
}
?>
<?php
if (!isset($_SESSION['user_data'])) {
    $_SESSION['message'] = "Invalid Action";
    header('Location: ../index.php');
}else{
    if (!isset($_POST['btn_add_coins'])) {
        $_SESSION['message'] = "Invalid Action";
        header('Location: ../home.php');
    }else{
        if(empty($_POST['coins_number'])){
            $_SESSION['message'] = "All fields must be filled in";
            header('Location: ../add_coins.php');
        }else{
            $new_coins = new Coins();
        }
    }
}
?>