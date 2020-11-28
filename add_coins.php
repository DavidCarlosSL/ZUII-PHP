<?php
session_start();
require_once 'includes/header.php';
?>

<?php
if(!empty($_SESSION['message'])){ ?>
    <div class="alert alert-dismissible alert-primary float-right wow fadeInRight" style="margin-right: 5%;height: 50px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p style="text-align: center;"> <?php echo $_SESSION['message'] ?> </p>
    </div>
<?php
}
unset($_SESSION['message']);
?>

<div>
    <center>
    <br><br><br>
    <h3 style="font-famil y: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;" id="library">Add Coins</h3><a href="coins.php" class="btn" style="font-size: 20px;"><i class="fas fa-arrow-circle-left"></i></a>
    </center>
</div>

<center>
    <div style="width: 42%; margin: 3% 0px 0px 0px;" class="wow fadeIn">
        <form method="POST" action="action_coins/action_add_coins.php">
            <div class="form-group">
                <label class="float-left">Coins</label>
                <input type="text" class="form-control" placeholder="Coins" name="coins_number">
            </div>
            <button type="submit" class="btn bg-secondary float-left" name="btn_add_coins"><i class="fas fa-plus">&nbsp</i>Add</button>
        </form>
        <p class="float-right" style="margin-top: 2%;"> Enter the number of coins you want to add </p>
    </div> 
</center>

<?php
require_once 'includes/footer.php';
?>