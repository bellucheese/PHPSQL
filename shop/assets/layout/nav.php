<?php
    session_start();

?>
<!doctype html>

<html>

<head>
    <title>Shop of all Shops</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bs-min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <style>
        .card-img-top {
            width: 100%;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">S.O.S.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/shop">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/shop/itemView.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/shop/about.php">About</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(!isset($_SESSION['user_id'])){
                        echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li><li class='nav-item'><a class='nav-link' href='register.php'>Register</a></li>";
                    }else{
                        echo "<li class='navbar-text' style='color:white'>" . $_SESSION['email'] . "</li> <li class='nav-item'><form method='post' action=''> <input class='btn btn-primary' type='submit' name='acp' value='AdminCP'> <input class='btn btn-secondary' type='submit' name='logout' value='Logout'></form></li>";
                    }

                    if(isset($_POST['logout'])){
                        session_destroy();
                        header("Location: index.php?logout=success");
                    }
                    if(isset($_POST['acp'])){
                        header("Location: admin.php");
                    }
                ?>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> Cart (<?php
                        if(isset($_SESSION['cart']))
                        {
                            echo sizeof($_SESSION['cart']);
                        }
                        else{
                            echo 0;
                        }

                        ?> Item(s))</a></li>
            </ul>
        </div>
    </div>
</nav>



<br><!-- END OF NAV -->

<div class="container">