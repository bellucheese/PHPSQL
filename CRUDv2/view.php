<!doctype html>
<html>
<body>
<a href="update.php">Update/Delete</a> | |
<a href="view.php">View</a> | |
<a href="index.php">Add</a>
<form method="get" action="#">
    Sort Column:
    <select name="sortCol">
        <option value="none">None</option>
        <option value="id">ID</option>
        <option value="corp">Corp. Name</option>
        <option value="zipcode">ZIP</option>
        <option value="owner">Owner Name</option>
        <option value="phone">Phone Number</option>
    </select>
    <select name="sortMode">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select>
    <input type="submit" name="sort" value="Sort">
</form>
<form method="get" action="#">
    Search:
    <select name="sortCol">
        <option value="none">None</option>
        <option value="id">ID</option>
        <option value="corp">Corp. Name</option>
        <option value="zipcode">ZIP</option>
        <option value="owner">Owner Name</option>
        <option value="phone">Phone Number</option>
    </select>
    <input type="text" name="searchTerm" placeholder="Search Term">
    <input type="submit" name="search" value="Search">
</form>
</body>
</html>

<?php
include 'assets/dbconn.php';
$sqlstmt = "SELECT * FROM corps";
    if(isset($_GET['sort'])){
        if($_GET['sortCol'] == "none"){
            $sqlstmt = "SELECT * FROM corps";
        }
        else{
            if($_GET['sortCol'] == "id"){
                if($_GET['sortMode'] == "DESC"){
                    $sortmode = "DESC";
                }else{
                    $sortmode = "ASC";
                }
                $sqlstmt = "SELECT * FROM corps ORDER BY id $sortmode";
            }
            elseif($_GET['sortCol'] == "corp"){
                if($_GET['sortMode'] == "DESC"){
                    $sortmode = "DESC";
                }else{
                    $sortmode = "ASC";
                }
                $sqlstmt = "SELECT * FROM corps ORDER BY corp $sortmode";
            }
            elseif($_GET['sortCol'] == "zipcode"){
                if($_GET['sortMode'] == "DESC"){
                    $sortmode = "DESC";
                }else{
                    $sortmode = "ASC";
                }
                $sqlstmt = "SELECT * FROM corps ORDER BY zipcode $sortmode";
            }
            elseif($_GET['sortCol'] == "owner"){
                if($_GET['sortMode'] == "DESC"){
                    $sortmode = "DESC";
                }else{
                    $sortmode = "ASC";
                }
                $sqlstmt = "SELECT * FROM corps ORDER BY owner $sortmode";
            }
            elseif($_GET['sortCol'] == "phone"){
                if($_GET['sortMode'] == "DESC"){
                    $sortmode = "DESC";
                }else{
                    $sortmode = "ASC";
                }
                $sqlstmt = "SELECT * FROM corps ORDER BY phone $sortmode";
            }

        }
    }
    if(isset($_GET['search'])){
        $searchTerm = $_GET['searchTerm'];
        if($_GET['sortCol'] == "none"){
            $sqlstmt = "SELECT * FROM corps";
        }
        else{
            if($_GET['sortCol'] == "id"){
                $sqlstmt = "SELECT * FROM corps WHERE id LIKE '%$searchTerm%'";
            }
            elseif($_GET['sortCol'] == "corp"){
                $sqlstmt = "SELECT * FROM corps WHERE corp LIKE '%$searchTerm%'";
            }
            elseif($_GET['sortCol'] == "zipcode"){
                $sqlstmt = "SELECT * FROM corps WHERE zipcode LIKE '%$searchTerm%'";
            }
            elseif($_GET['sortCol'] == "owner"){
                $sqlstmt = "SELECT * FROM corps WHERE owner LIKE '%$searchTerm%'";
            }
            elseif($_GET['sortCol'] == "phone"){
                $sqlstmt = "SELECT * FROM corps WHERE phone LIKE '%$searchTerm%'";
            }
        }
    }
    try{$sql = dbconn()->prepare($sqlstmt);
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