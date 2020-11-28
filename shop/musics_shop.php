<?php
require_once '../services/dbconnection.php';
require_once '../includes/header.php';
?>

<?php
if (!isset($_SESSION['user_data'])) {
    $_SESSION['message'] = "You must be authenticated";
    header('Location: ../index.php');
}else{
    if (!isset($_GET['art']) || !isset($_GET['al'])) {
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
    <h3 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;">Musics from <?php echo $_GET['art']?> - <?php echo $_GET['al']; ?></h3><a href="albums_shop.php?art=<?php echo $_GET['art']; ?>" class="btn" style="font-size: 20px;"><i class="fas fa-arrow-circle-left"></i></a>
    </center>
</div>
<center>

<div style="margin-top: 2%;" class="wow fadeIn">
    <table class="table">
        <thead>
            <tr>
            <th scope="col"></th>
            <th scope="col"><i class="fas fa-compact-disc">&nbsp</i>Album</th>       
            <th scope="col"><i class="fas fa-signature">&nbsp</i>Name</th>
            <th scope="col"><i class="far fa-clock">&nbsp</i>Duration</th>
            <th scope="col"><i class="fas fa-tags">&nbsp</i>Price</th>
            <th scope="col"><i class="fas fa-hand-holding-usd">&nbsp</i>Buy</th>
            </tr>
        </thead>
        <tbody>
<?php
$nome_artista = $_GET['art'];
$nome_album = $_GET['al'];
$query = "SELECT * FROM musica_album as ma INNER JOIN musica as m on ma.cd_musica = m.cd_musica INNER JOIN album as al on ma.cd_album = al.cd_album INNER JOIN artista as art on art.cd_artista = al.cd_artista WHERE art.nome_artista = '$nome_artista' AND al.nome_album = '$nome_album'";
$answer_query = mysqli_query($connection, $query);
while($array = mysqli_fetch_array($answer_query)){ ?>
    <tr class="table">
        <td scope="row"><img src='<?php echo "../".$array["imagem_album"]; ?>' height="40px" width="40px" class="rounded"></td>
        <td><?php echo $array['nome_album'];?></td>
        <td><?php echo $array['nome_musica'];?></td>
        <td><?php echo $array['tempo_duracao'];?></td>
        <td><i class="fas fa-coins">&nbsp</i><?php echo $array['preco_musica'];?></td>
        <td><a class="btn btn-sm btn-success" href='../purchase.php?al=<?php echo $nome_album; ?>&art=<?php echo $nome_artista; ?>&m=<?php echo $array['nome_musica'];?>'> Buy </a></td>
    </tr>
<?php
}
?>
        </tbody>
    </table>
</div>
</center>
<?php
require_once '../includes/footer.php';
?>