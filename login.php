<?php
session_start();
require_once 'includes/header.php';
?>

<?php
if(!empty($_SESSION['message'])){ ?>
    <div class="alert alert-dismissible alert-primary float-right" style="margin-right: 5%;height: 50px;">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p style="text-align: center;"> <?php echo $_SESSION['message'] ?> </p>
    </div>
<?php
}
unset($_SESSION['message']);
?>

<center>
    <div style="width: 42%; margin: 12% 0px 0px 0px;">
        <form method="POST" action="action_user/user_login.php">
            <div class="form-group">
                <label class="float-lefts">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="email_login">
            </div>
            <div class="form-group">
                <label class="float-left">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password_login">
            </div>
            <button type="submit" class="btn bg-secondary float-left" name="btn_login">Login</button>
        </form>
        <a href="signup.php" class="float-right" style="margin-top: 2%;"> Do not have a account? </a>
    </div> 
</center>
<?php
require_once 'includes/footer.php';
?>