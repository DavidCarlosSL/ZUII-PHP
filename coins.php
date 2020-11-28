<?php
require_once 'services/dbconnection.php';
require_once 'includes/header.php';
?>

<div>
    <center>
    <br><br><br>
    <h3>Your Purchases</h3><a href="home.php" class="btn" style="font-size: 20px;"><i class="fas fa-arrow-circle-left"></i></a>   
    <br><br>
    <a class="btn btn-secondary" href="add_coins.php" style=""><i class="fas fa-plus">&nbsp</i>Add Coins</a>
    </center>
</div>

<?php
$cd_usu = $_SESSION['user_data']['cd_usu'];
$query = "SELECT * FROM musica_compra as mc INNER JOIN compra as c on mc.cd_compra = c.cd_compra INNER JOIN musica_album as ma on mc.cd_musica = ma.cd_musica INNER JOIN album as al on ma.cd_album = al.cd_album INNER JOIN artista as art on al.cd_artista = art.cd_artista INNER JOIN musica as m on mc.cd_musica = m.cd_musica WHERE c.cd_usu = '$cd_usu' ORDER BY data_compra";
$answer_query = mysqli_query($connection, $query);
$rows = mysqli_num_rows($answer_query);
if(!empty($rows)){ ?>
    <center>
    <div style="margin-top: 2%;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"><i class="fas fa-user">&nbsp</i>Artist</th>
                    <th scope="col"><i class="fas fa-compact-disc">&nbsp</i>Album</th>
                    <th scope="col"><i class="fas fa-signature">&nbsp</i>Music</th>
                    <th scope="col"><i class="fas fa-shopping-cart">&nbsp</i>Value</th>
                    <th scope="col"><i class="far fa-calendar">&nbsp</i>Date</th>
                </tr>
            </thead>
            <tbody class="wow fadeIn">
<?php
    while ($array = mysqli_fetch_array($answer_query)) { ?>
         <tr class="table">
            <td scope="row"><img src='<?php echo $array["imagem_album"]; ?>' height="40px" width="40px" class="rounded"></td>
            <td><?php echo $array['nome_artista'];?></td>
            <td><?php echo $array['nome_album'];?></td>
            <td><?php echo $array['nome_musica'];?></td>
            <td><i class="fas fa-coins">&nbsp</i><?php echo $array['valor_compra'];?></td>
            <td><?php echo $array['data_compra'];?></td>
        </tr> 
<?php        
    }
}else{ ?>
    <br>
    <center>
        <h4 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;">You have not purchased anything yet. <a href="shop/artists_shop.php" style="text-decoration: none;"> Buy Musics </a></h4>
    </center>
<?php
}
?>

<?php 
require_once 'includes/footer.php';
?>