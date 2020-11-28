<?php
session_start();
require_once "includes/header.php";
?>

<?php
if(!empty($_SESSION['message'])){ ?>
    <div class="alert alert-dismissible alert-primary" style="margin-right: 5%;height: 50px; float: right;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p style="text-align: center;"> <?php echo $_SESSION['message'] ?> </p>
    </div>
<?php
}
unset($_SESSION['message']);
?>

<center>
    <div style="width: 42% ;margin: 10% 0px 0px 0px;">
        <form method="POST" action="action_user/user_signup.php">
            <div class="form-group">
                <label style="float: left;">Name</label>
                <input type="text" class="form-control" placeholder="Name" name="name_signup">
            </div>
            <div class="form-group">
                <label style="float: left;">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email_signup">
            </div>
            <div class="form-group">
                <label style="float: left;">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password_signup">
            </div>
            <button type="submit" class="btn bg-secondary" style="float: left;" name="btn_signup">Sign up</button>
        </form>
        <a href="login.php" style="float: right; margin-top: 2%;"> Have already an account? </a>
    </div> 
</center>
<?php
require_once "includes/footer.php";
?>