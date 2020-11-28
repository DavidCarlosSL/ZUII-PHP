<?php
require_once 'services/dbconnection.php';
require_once 'includes/header.php';
?>

<?php
if (!isset($_SESSION['user_data'])) {
    $_SESSION['message'] = "You must be authenticated";
    header('Location: index.php');
}else{
    if (!isset($_GET['art']) || !isset($_GET['al']) || !isset($_GET['m'])) {
        $_SESSION['message'] = "Invalid action";
        header('Location: artists_shop.php');
    }else{
        if (!empty($_SESSION['message'])) { ?>
        <div class="alert alert-dismissible alert-primary float-right" style="margin-right: 5%; height: 50px;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p style="text-align: center;"> <?php echo $_SESSION['message']; ?> </p>
        </div>  
<?php
    }
    unset($_SESSION['message']);
}
}
?>
<div>
    <center>
    <br><br><br>
    <h3 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;" class="wow fadeIn">Do you want to buy: <?php echo $_GET['art']; ?> - <?php echo $_GET['m']; ?>?</h3><a href='shop/musics_shop.php?al=<?php echo $_GET['al']; ?>&art=<?php echo $_GET['art'] ?>' class="btn wow fadeIn" style="font-size: 20px;"><i class="fas fa-arrow-circle-left"></i></a>
    </center>
</div>

<?php
$nome_artista = $_GET['art'];
$nome_album = $_GET['al'];
$nome_musica = $_GET['m'];

$query = "SELECT * FROM musica_album as ma INNER JOIN musica as m on ma.cd_musica = m.cd_musica INNER JOIN album as al on ma.cd_album = al.cd_album INNER JOIN artista as art on al.cd_artista = art.cd_artista WHERE m.nome_musica = '$nome_musica' AND al.nome_album = '$nome_album' AND art.nome_artista = '$nome_artista'";
$answer_query = mysqli_query($connection, $query);
$array = mysqli_fetch_array($answer_query);

?>
<center>
<div class="wow fadeIn">
    <img src='<?php echo $array['imagem_album'] ?>' height="230px" widht="170px">
    <p> <?php echo $array['nome_artista']." - ".$array['nome_musica']; ?> </p>
    <p> <?php echo $array['nome_album']; ?> </p>
    <a href="action_purchase/action_purchase.php?al=<?php echo $array['nome_album']; ?>&art=<?php echo $array['nome_artista']; ?>&m=<?php echo $array['nome_musica'];?>" class="btn btn-lg bg-danger" style="padding: 0px 50px 0px 50px;">Yes </a>
</div>
</center>
<?php
require_once 'includes/footer.php';
?>