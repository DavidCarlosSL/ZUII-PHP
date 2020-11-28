<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>ZUII</title>

    <style>
      .wow:first-child {
        visibility: hidden;
      }
    </style>

    <!-- CSS -->
    <?php 
    if($_SERVER['PHP_SELF'] == "/zuii/shop/artists_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/albums_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/musics_shop.php"){ ?>
      <link rel="stylesheet" type="text/css" href="../css/main.css">
      <link rel="stylesheet" href="../css/libs/animate.css">
    <?php
    }else{ ?>
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <link rel="stylesheet" href="css/libs/animate.css">
    <?php
    }
    ?>

  </head>
  <body>
  <div id="main">
  <?php
  if($_SERVER['PHP_SELF'] == "/zuii/index.php" || $_SERVER['PHP_SELF'] == "/zuii/login.php" || $_SERVER['PHP_SELF'] == "/zuii/signup.php"){ ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
      <a class="navbar-brand" href="index.php" id="logo">ZUII</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor03" style="margin-left: 70%;">
        <ul class="navbar-nav mr-auto">
          <li>
            <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt">&nbsp</i>Login</a>
          </li>
          <li>
            <a class="nav-link" href="signup.php"><i class="fas fa-user-plus">&nbsp</i>Sign up</a>
          </li>
        </ul>
      </div>
    </nav>
    
  <?php
  }else{ ?> 
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
    <?php 
    if($_SERVER['PHP_SELF'] == "/zuii/shop/artists_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/albums_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/musics_shop.php"){ ?>
      <a class="navbar-brand" href="../home.php" id="logo">ZUII</a>
    <?php
    }else{ ?>
      <a class="navbar-brand" href="home.php" id="logo">ZUII</a>
    <?php
    }
    ?>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03" style="margin-left: 61%;">
          <ul class="navbar-nav mr-auto">
            <?php
              if($_SERVER['PHP_SELF'] == "/zuii/shop/artists_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/albums_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/musics_shop.php"){ ?>
              <li>
                <a class="nav-link" href="../coins.php"><i class="fas fa-coins">&nbsp</i>Coins <?php echo $_SESSION['user_data']['saldo_usu'];?></a>
              </li>        
              <li>
                <a class="nav-link" href="artists_shop.php"><i class="fas fa-cart-plus">&nbsp</i>Buy</a>
              </li>
              <li>
                  <a class="nav-link" href="../home.php"><i class="fas fa-book">&nbsp</i>Library</a>
              </li>
              <li>
                <a class="nav-link btn btn-sm bg-danger active" href="../logout.php"><i class="fas fa-door-open">&nbsp</i>Logout</a>
              </li>
            <?php
              }else{ ?>
                <li>
                  <a class="nav-link" href="coins.php"><i class="fas fa-coins">&nbsp</i>Coins <?php echo $_SESSION['user_data']['saldo_usu'];?></a>
                </li> 
                <li>
                  <a class="nav-link" href="shop/artists_shop.php"><i class="fas fa-cart-plus">&nbsp</i>Buy</a>
                </li>
                <li>
                  <a class="nav-link" href="home.php"><i class="fas fa-book">&nbsp</i>Library</a>
                </li>
                <li>
                  <a class="nav-link btn btn-sm bg-danger active" href="logout.php"><i class="fas fa-door-open">&nbsp</i>Logout</a>
                </li>
            <?php
              }
            ?>
            
          </ul>
        </div>
    </nav>
    <?php 
    if($_SERVER['PHP_SELF'] == "/zuii/shop/artists_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/albums_shop.php" || $_SERVER['PHP_SELF'] == "/zuii/shop/musics_shop.php"){ ?>
      <script src="../dist/wow.js"></script>
    <?php
    }else{ ?>
      <script src="dist/wow.js"></script>
    <?php
    }
    ?>
    <script>
      wow = new WOW(
        {
          animateClass: 'animated',
          offset:       100,
          callback:     function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
          }
        }
      );
      wow.init();
      document.getElementById('moar').onclick = function() {
        var section = document.createElement('section');
        section.className = 'section--purple wow fadeInDown';
        this.parentNode.insertBefore(section, this);
      };
    </script>
  <?php
  }
  ?>