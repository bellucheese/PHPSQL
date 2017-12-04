<?php
    include_once 'assets/layout/nav.php';
    if(isset($_GET['registration']) == 'success'){
        echo "<div class='alert alert-success'>SUCCESS: <b>Registration</b> complete! Feel free to login!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
    if(isset($_GET['login']) == 'success'){
        echo "<div class='alert alert-success'>SUCCESS: <b>Login</b> complete! Feel free to look around and shop!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
    if(isset($_GET['logout']) == 'success'){
        echo "<div class='alert alert-success'>SUCCESS: <b>Logout</b> complete! See ya later!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
?>
<h3>Featured Items from the Shop of all Shops!</h3><hr>
<div class="row">
<?php
    require 'assets/functions.php';
    require 'assets/dbconn.php';
    outputItemCard(dbconn(), 1);
    outputItemCard(dbconn(), 2);
?></div>
<br>
    <div class="row">
        <?php
        outputItemCard(dbconn(), 3);
        outputItemCard(dbconn(), 4);
        ?></div>
<?php include_once 'assets/layout/footer.php'?>