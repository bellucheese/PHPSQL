<!doctype html>
<html>
<body>
<a href="update.php">Update/Delete</a> | |
<a href="view.php">View</a> | |
<a href="index.php">Add</a>
<?php
include 'assets/dbconn.php';
include 'assets/add.php';

//I know this looks a bit messy but it's currently 4 in the morning before this is
// due and I finally got it working.
// I had SQL problems but I learned a ton from just that alone.

    if(isset($_GET['id'])){
        try{$sql = dbconn()->prepare("SELECT * FROM corps WHERE id = ".$_GET['id']."");
            $sql->execute();
            $corps = $sql->fetchAll(PDO::FETCH_ASSOC);
            if($sql->rowCount() > 0){
                $output = "<form action='#' method='post'>";
                foreach($corps as $corp){
                    $output .= "
                    Corp.: <input type='text' name='corp' value='".$corp['corp']."'>
                    E-Mail: <input type='text' name='email' value='".$corp['email']."'>
                    Zip: <input type='text' name='zipcode' value='".$corp['zipcode']."'><br>
                    Owner: <input type='text' name='owner' value='".$corp['owner']."'>
                    Phone: <input type='text' name='phone' value='".$corp['phone']."'>
                    <input type='submit' name='submit' value='Modify'>";
                }
                $output .= "</form>";
            }else{
                $output = "Life is sad lol, no actors 4 u";
            }
            echo $output;
        }
        catch(PDOException $e){
            die("There was a problem retrieving the actors");
        }
        $db = dbconn();
        $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING) ?? "";
        $corp = filter_input(INPUT_POST,'corp',FILTER_SANITIZE_STRING) ?? "";
        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
        $owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";
        //switch statment to decide which button is being pressed(using later)
        switch ($submit){
            case "Modify":

                modCorp($db, $corp, $email, $zipcode, $owner, $phone, $_GET['id']);
                break;
        }
    }
?>

</body>
</html>
<?php

try{$sql = dbconn()->prepare("SELECT * FROM corps");
    $sql->execute();
    $corps = $sql->fetchAll(PDO::FETCH_ASSOC);
    if($sql->rowCount() > 0){
        $table = "<table class='table table-striped'>" . PHP_EOL;
        $table .= "<tr><th>ID</th><th>Corp</th><th> </th><th> </th></tr>";
        foreach($corps as $corp){
            $table .= "<tr><td>".$corp['id']."</td><td>".$corp['corp']."</td><td><a href='update.php?id=".$corp['id']."'>Update</a></td><td><a href='assets/delete.php?id=".$corp['id']."'>Delete</a></td></tr>";
        }
        $table .= "</table>" . PHP_EOL;
    }else{
        $table = "Life is sad lol, no actors 4 u";
    }
    echo $table;
}
catch(PDOException $e){
    die("There was a problem retrieving the corps");
}
?>