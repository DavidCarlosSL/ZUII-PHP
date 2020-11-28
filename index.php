<?php
session_start();
include_once 'includes/header.php';
?>
<br>
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
<center>
    <div id="slogan">
        <h1>A simple and modern service that<br>offers a essential thing of life:<br><h1 style="text-decoration: underline; text-decoration-style: double;">The Music</h1></h1>
    </div>
</center>

<?php
include_once 'includes/footer.php';
?>