<!doctype html>
<html>
<body>
<a href="update.php">Update/Delete</a> | |
<a href="view.php">View</a> | |
<a href="index.php">Add</a>
</body>
</html>
<?php
include 'assets/dbconn.php';

    try{$sql = dbconn()->prepare("SELECT * FROM corps");
        $sql->execute();
        $corps = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0){
        $table = "<table class='table table-striped'>" . PHP_EOL;
            $table .= "<tr><th>ID</th><th>Corp</th><th>Date/Time</th><th>E-Mail</th><th>Zip Code</th><th>Owner</th><th>Phone</th></tr>";
            foreach($corps as $corp){
            $table .= "<tr><td>".$corp['id']."</td><td>".$corp['corp']."</td><td>" . $corp['incorp_dt'] . "</td><td>" . $corp['email'] . "</td><td>" . $corp['zipcode'] . "</td><td>".$corp['owner']."</td><td>".$corp['phone']."</td></tr>";
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