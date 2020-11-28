<?php
require_once '../services/dbconnection.php';
require_once '../includes/header.php';
?>

<?php
if (!isset($_SESSION['user_data'])) {
    $_SESSION['message'] = "You must be authenticated";
    header('Location: ../index.php');
}else{
    if (!isset($_GET['art'])) {
        $_SESSION['message'] = "Invalid action";
        header('Location: artists_shop.php');
    }else{
        if (!empty($_SESSION['message'])) { ?>
        <div class="alert alert-dismissible alert-primary float-right wow fadeInRight" style="margin-right: 5%; height: 50px;">
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
    <h3 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;">Albums from <?php echo $_GET['art']; ?></h3><a href="artists_shop.php" class="btn" style="font-size: 20px;"><i class="fas fa-arrow-circle-left"></i></a>
    </center>
</div>
<div style="margin-left: 2%;">
    <table style="width:100%">
        <tr>
<?php
$nome_artista = $_GET['art'];
$query = "SELECT * FROM album as al INNER JOIN artista as art on al.cd_artista = art.cd_artista WHERE nome_artista = '$nome_artista'";
$answer_query = mysqli_query($connection, $query);
while($array = mysqli_fetch_array($answer_query)){?>

    <div class="card bg-transparent music-card float-left border-0">
        <a href='musics_shop.php?art=<?php echo $nome_artista; ?>&al=<?php echo $array['nome_album']; ?>' class="text-white" style="text-decoration: none;">
            <img src='<?php echo "../".$array["imagem_album"]; ?>' class="card-img-top wow fadeIn" style="height: 170px; widht: 170px;">
        <div class="card-body">
            <p class="card-text wow fadeIn" data-wow-offset="-1" style="text-align: center; font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;"><?php echo $array['nome_album'];?> </p>
        </div>
        </a>
    </div>
<?php
}
?>
        </tr>
    </table>
</div>
<?php
require_once '../includes/footer.php';
?>