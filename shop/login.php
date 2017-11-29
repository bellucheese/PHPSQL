<?php
    include_once 'assets/layout/nav.php';
?>
    <h2>Login</h2>
    <hr>

<?php
require_once 'assets/dbconn.php';
$db = dbconn();
if(isset($_SESSION['user_id'])){
    header("Location: index.php");
}
if(isset($_GET['login']) == 'failed'){
    echo "<div class='alert alert-danger'>ERROR: Login failed, username or password do not match up.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
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
        try{
            $email = $_POST['email'];
            $sql = $db->prepare("SELECT * FROM users WHERE email=:email");
            $sql->bindParam(':email', $email);
            $sql->execute();

            $user = $sql->fetch(PDO::FETCH_ASSOC);
            $numRows = $sql->rowCount();

            if($numRows < 1){
                header('Location: login.php?login=notEx');
            }else{

                if($_POST['password'] != $user['password']){
                    header("Location: login.php?login=failed");
                }else{
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['email'];
                    header("Location: index.php?login=success");
                    exit();
                }
            }

        }catch(PDOException $e){
            echo $e->getMessage();
            die("problem lol");
        }
    }
}
?>

    <form action="#" method="post">
        <div class="input-group">
            <span id="email" class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
            <input id="email" type="email" class="form-control" name="email" value="" placeholder="Email Address">
        </div>
        <br>
        <div class="input-group">
            <span id="password" class="input-group-addon"><i class="fa fa-key"></i></span>
            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">
        </div>
        <br>

        <input type="submit" class="btn btn-primary" name="submit" value="Login"> <span><a href="register.php">Register</a></span>
    </form>

