<!doctype html>
<html>
<body>
<a href="update.php">Update/Delete</a> | |
<a href="view.php">View</a> | |
<a href="index.php">Add</a>
</body>
</html>
<form method="get" action="#">
    Sort Column:
    <select>
        <option>ID</option>
        <option>Corp. Name</option>
        <option>ZIP</option>
        <option>Owner Name</option>
        <option>Phone Number</option>
    </select>
    <select>
        <option>Ascending</option>
        <option>Descending</option>
    </select>
    <input type="button" name="submit" value="Sort">
</form>
<form method="get" action="#">
    Search:
    <select>
        <option>ID</option>
        <option>Corp. Name</option>
        <option>ZIP</option>
        <option>Owner Name</option>
        <option>Phone Number</option>
    </select>
    <input type="text" name="searchTerm" placeholder="Search Term">
    <input type="button" name="submit" value="Search">
    <input type="button" name="submit" value="Reset Search">
</form>
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