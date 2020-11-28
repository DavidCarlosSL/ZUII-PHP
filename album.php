<?php
require_once 'services/dbconnection.php';
require_once 'includes/header.php';
?>

<?php
if (!isset($_SESSION['user_data'])) {
    $_SESSION['message'] = "You must be authenticated";
    header('Location: index.php');
}else{
    if (!isset($_GET['al'])) {
        $_SESSION['message'] = "Invalid action";
        header('Location: home.php');
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
    <h3 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;" id="library">Your songs in this album</h3><a href="home.php" class="btn" style="font-size: 20px;"><i class="fas fa-arrow-circle-left"></i></a>
    </center>
</div>
<?php
    $cd_album = $_GET['al'];
    $cd_biblioteca = $_SESSION['user_data']['cd_biblioteca'];
    $query = "SELECT * FROM musica_album as ma INNER JOIN biblioteca_musica as bm on ma.cd_musica = bm.cd_musica INNER JOIN musica as m on m.cd_musica = ma.cd_musica INNER JOIN album as al on al.cd_album = ma.cd_album WHERE cd_biblioteca ='$cd_biblioteca' AND ma.cd_album = '$cd_album'";
    $answer_query = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($answer_query);
    if (!empty($rows)) { ?>
        <center>
        <div style="margin-top: 2%;">
        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col"></th>
            <th scope="col"><i class="fas fa-compact-disc">&nbsp</i>Album</th>
            <th scope="col"><i class="fas fa-signature">&nbsp</i>Name</th>
            <th scope="col"><i class="far fa-clock">&nbsp</i>Duration</th>
            </tr>
        </thead>
        <tbody class="wow fadeIn">
    <?php
        while ($array = mysqli_fetch_array($answer_query)) { ?>
            <tr class="table">
                <td scope="row"><img src='<?php echo $array["imagem_album"]; ?>' height="40px" width="40px" class="rounded"></td>
                <td><?php echo $array['nome_album'];?></td>
                <td><?php echo $array['nome_musica'];?></td>
                <td><?php echo $array['tempo_duracao'];?></td>
            </tr>

<?php
        }
    }else{ ?>
        <center>
        <h4 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;">You don't have any songs from this album. <a href="shop/artists_shop.php" style="text-decoration: none;"> Buy Musics </a></h4>
        </center>
<?php
    }
?>
        </tbody>
</table>
</div>
</center>
<?php
require_once 'includes/footer.php';
?>