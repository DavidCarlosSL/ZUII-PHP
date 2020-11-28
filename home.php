<?php
require_once 'services/dbconnection.php';
?>
<?php
if (!isset($_SESSION['user_data'])) {
    $_SESSION['message'] = "You must be authenticated";
    header('Location: index.php');
}else{
    require_once 'includes/header.php';
    if (!empty($_SESSION['message'])) { ?>
    <div class="alert alert-dismissible alert-primary float-right wow fadeInRight" style="margin-right: 5%; height: 50px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p style="text-align: center;"> <?php echo $_SESSION['message']; ?> </p>
    </div>
<?php
    }
    unset($_SESSION['message']);
}
?>
<center>
<br><br><br>
<h3 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;">Your Library</h3>
</center>
<div style="margin-left: 2%;">
    <table style="width:100%">
        <tr>
<?php
    $cd_biblioteca = $_SESSION['user_data']['cd_biblioteca'];
    $query = "SELECT * FROM biblioteca_album as ba INNER JOIN album as a on ba.cd_album = a.cd_album WHERE cd_biblioteca = '$cd_biblioteca'";
    $answer_query = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($answer_query);
    if (!empty($rows)) {
        while ($array = mysqli_fetch_array($answer_query)) { ?>
        <div class="card bg-transparent music-card float-left border-0">
            <a href='album.php?al=<?php echo $array['cd_album']?>' class="text-white" style="text-decoration: none;">
                <img src='<?php echo $array["imagem_album"]; ?>' class="card-img-top wow fadeIn rounded" style="height: 170px; widht: 170px;" >
            <div class="card-body">
                <p class="card-text wow fadeIn" data-wow-offset="-1" style="text-align: center; font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;"><?php echo $array['nome_album'];?> </p>
            </div>
            </a>
        </div>
<?php
        }
    }else{ ?>
        <center>
        <h4 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;">Your library is empty. <a href="shop/artists_shop.php" style="text-decoration: none;"> Buy Musics </a></h4>
        </center>
<?php
    }
?> 
        </tr>
    </table>
</div>
<?php
require_once 'includes/footer.php';
?>
