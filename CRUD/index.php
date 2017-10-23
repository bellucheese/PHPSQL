<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 10/22/2017
 * Time: 11:21 PM
 */?>

<!doctype html>
<html>
<head>
    <title>Add</title>
</head>
<body>
<?php
    //includes
    require_once 'assets/dbconn.php';
    require_once 'assets/add.php';
    //assignment of variables
    $db = dbconn();
    $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING) ?? "";
    $corp = filter_input(INPUT_POST,'corp',FILTER_SANITIZE_STRING) ?? "";
    $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
    $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";
    //switch statment to decide which button is being pressed(using later)
    switch ($submit){
        case "Add":
            addCorp($db, $corp, $email, $zipcode, $owner, $phone);
            break;
    }

?>

<a href="update.php">Update/Delete</a> | |
<a href="view.php">View</a> | |
<a href="index.php">Add</a>
<form action="#" method="post">
    Corp.: <input type="text" name="corp"><br>
    E-Mail: <input type="text" name="email"><br>
    Zip: <input type="text" name="zipcode"><br>
    Owner: <input type="text" name="owner"><br>
    Phone: <input type="text" name="phone"><br>
    <input type="submit" name="submit" value="Add">
</form>
</body>
</html>
