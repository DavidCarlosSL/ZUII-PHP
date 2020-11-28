<?php
require_once '../services/dbconnection.php';
require_once '../services/generator.php';
require_once '../services/cf.php';
?>
<?php

class Purchase 
{
    private $artist;
    private $album;
    private $music;
    private $user_library;
    private $user_coins;
    private $cd_album;
    private $cd_music;
    private $cd_user;
    private $option;
    private $music_price;
    
    function __construct(){
        $this->setUser($_SESSION['user_data']['cd_usu']);
        $this->setArtist($_GET['art']);
        $this->setAlbum($_GET['al']);
        $this->setMusic($_GET['m']);
        $this->setUserLibrary($_SESSION['user_data']['cd_biblioteca']);
        $this->checkMusic();
    }

    public function setUser($cd_user){
        global $connection;
        $query = "SELECT * FROM usuario WHERE cd_usu = '$cd_user'";
        $answer_query = mysqli_query($connection, $query);
        $array = mysqli_fetch_array($answer_query);
        $this->cd_user = $array['cd_usu'];
        $this->user_coins = $array['saldo_usu'];
    }

    public function setArtist($artist){
        $this->artist = LC($artist);
    }
    
    public function setAlbum($album){
        $this->album = LC($album);
    }

    public function setMusic($music){
        $this->music = LC($music);
    }

    public function setUserLibrary($library){
        $this->user_library = LC($library);
    }

    public function checkMusic(){
        global $connection;
        $query = "SELECT * FROM musica_album as ma INNER JOIN musica as m on ma.cd_musica = m.cd_musica INNER JOIN album as al on ma.cd_album = al.cd_album INNER JOIN artista as art on al.cd_artista = art.cd_artista WHERE m.nome_musica = '$this->music' AND al.nome_album = '$this->album' AND art.nome_artista = '$this->artist'";
        $answer_query = mysqli_query($connection, $query);
        $rows = mysqli_num_rows($answer_query);
        if(!empty($rows)){
            $array = mysqli_fetch_array($answer_query);
            $this->music_price = LC($array['preco_musica']);
            if ($this->user_coins < $this->music_price) {
                $_SESSION['message'] = "You don't have enought coins to buy this song";
                $header = 'Location: ../shop/musics_shop.php?art='.$_GET['art'].'&al='.$_GET['al'];
                header($header);
            }else{
                $this->cd_album = LC($array['cd_album']);
                $this->cd_music = LC($array['cd_musica']);  
                $this->checkLibrary();
            }
        }else{
            $_SESSION['message'] = "Invalid action";
            header('Location: ../shop/artists_shop.php');
        }
    }

    private function checkLibrary(){
        global $connection;
        $query = "SELECT * FROM biblioteca_musica WHERE cd_biblioteca = '$this->user_library' AND cd_musica = '$this->cd_music'";
        $answer_query = mysqli_query($connection, $query);
        $rows = mysqli_num_rows($answer_query);
        if(!empty($rows)){
            $_SESSION['message'] = "You already own this song";
            $header = 'Location: ../shop/musics_shop.php?art='.$_GET['art'].'&al='.$_GET['al'];
            header($header);
        }else{
            $query = "SELECT * FROM biblioteca_album WHERE cd_biblioteca = '$this->user_library' AND cd_album = '$this->cd_album'";
            $answer_query = mysqli_query($connection, $query);
            $rows = mysqli_num_rows($answer_query);
            $this->user_coins -= $this->music_price;
            $query = "UPDATE usuario SET saldo_usu = '$this->user_coins' WHERE cd_usu = '$this->cd_user'";
            $answer_query = mysqli_query($connection, $query);
            if(!empty($rows)){
                $this->option = 0;
                $this->AddToLibrary();
            }else{
                $this->option = 1;
                $this->AddToLibrary();
            }
        }
    }

    private function AddToLibrary(){
        global $connection;
        $query = "INSERT INTO biblioteca_musica (cd_musica, cd_biblioteca) VALUES ('$this->cd_music', '$this->user_library')";
        $answer_query = mysqli_query($connection, $query);
        if ($this->option == 0) {
            $this->AddToBought();
        }else{
            if ($this->option == 1) {
                $query = "INSERT INTO biblioteca_album (cd_biblioteca, cd_album) VALUES ('$this->user_library', '$this->cd_album')";
                $answer_query = mysqli_query($connection, $query);
                $this->AddToBought();
            }
        }    
    }

    private function AddToBought(){
        global $connection;
        date_default_timezone_set("America/Sao_Paulo");
        $date = date('Y/d/m');
        $cd_compra = gerar();
        $query = "INSERT INTO compra (cd_compra, valor_compra , data_compra, cd_usu) VALUES ('$cd_compra', '$this->music_price', '$date', '$this->cd_user')";
        $answer_query = mysqli_query($connection, $query);
        $query = "INSERT INTO musica_compra (cd_compra, cd_musica) VALUES ('$cd_compra', '$this->cd_music')";
        $answer_query = mysqli_query($connection, $query);
        $_SESSION['user_data']['saldo_usu'] = $this->user_coins;
        $_SESSION['message'] = 'Music successfully purchased';
        $header = 'Location: ../shop/musics_shop.php?art='.$_GET['art'].'&al='.$_GET['al'];
        header($header);
    }
}

if (!isset($_SESSION['user_data'])) {
    $_SESSION['message'] = "Invalid Action";
    header('Location: ../index.php');
}else{
    if (!isset($_GET['art']) || !isset($_GET['al']) || !isset($_GET['m'])) {
        $_SESSION['message'] = "Invalid Action";
        header('Location: ../shop/artists_shop.php');
    }else{
        $new_purchase = new Purchase();
    }
}
?>