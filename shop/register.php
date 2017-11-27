<?php
include_once 'assets/layout/nav.php';
require_once 'assets/dbconn.php';
include_once 'assets/functions.php';
?>

<h2>Register</h2>
<hr>
<?php
if(isset($_POST['submit'])){
    if(empty($_POST['email']) || empty($_POST['password'])){
        echo "<div class='alert alert-danger'>ERROR: One or more of the fields is not filled in.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        if(empty($_POST['email'])){
            echo "<style>#email{border-color: #cc4d4d;background-color: #ffbfbf;}</style>";
        }
        if(empty($_POST['password'])){
            echo "<style>#password{border-color: #cc4d4d;background-color: #ffbfbf;}</style>";
        }
    }else{
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "<div class='alert alert-danger'>ERROR: Not a valid email.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            echo "<style>#email{border-color: #cc4d4d;background-color: #ffbfbf;}</style>";
        }else{
            if(userFind(dbconn(), $_POST['email']) > 0){
                echo "<div class='alert alert-warning' role='alert'>ERROR: This email already exists, if you own this account, log in <a href='login.php' class='alert-link'><b>HERE</b></a>.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }else{
                registerUser(dbconn(), $_POST['email'], $_POST['password']);
                session_start();
                header("Location: index.php?registration=success");
            }
        }
    }
}
?>

<form action="#" method="post">
    <div class="input-group">
        <span id="email" class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
        <input id="email" type="text" class="form-control" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}else{echo "";}?>" placeholder="Email Address">
    </div>
    <br>
    <div class="input-group">
        <span id="password" class="input-group-addon"><i class="fa fa-key"></i></span>
        <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">
    </div>
    <br>

    <input type="submit" class="btn btn-primary" name="submit" value="Register">
</form>


