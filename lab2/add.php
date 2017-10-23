<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 2 | PHP</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #808080">
<?php
include_once 'assets/nav.html';
?>
<div class="wrapper">
    <div class="section" style="background-color: #fff;
    border-radius: 10px; padding-top: 10px;padding-bottom: 10px;">
        <h1 class="page-title">Add to Actors</h1>

        <?php
        //includes
        require_once 'assets/dbconn.php';
        require_once 'assets/actors.php';
        //assignment of variables
        $db = dbconn();
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
        $firstname = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING) ?? "";
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING) ?? "";
        $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
        $height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";
        //switch statment to decide which button is being pressed(using later)
        switch ($action){
            case "Add":
                addActor($db, $firstname, $lastname, $dob, $height);
                break;
        }
        ?>

        <form method="post" action="#">
            Name: <input type="text" name="firstname"><br>
            LName: <input type="text" name="lastname"><br>
            BDay: <input type="text" name="dob"><br>
            Height: <input type="text" name="height"<br>
            <input type="submit" name="action" value="Add">
        </form>
    </div>

</div>
</body>
</html>