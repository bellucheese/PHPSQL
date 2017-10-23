<?php
include 'dbconn.php';
include 'actors.php';
$db = dbconn();
$id = $_GET['id'];
try{$sql = $db->prepare("SELECT * FROM actors WHERE id=$id");
$sql->execute();
$actors = $sql->fetchAll(PDO::FETCH_ASSOC);
if($sql->rowCount() > 0){
    $form = "<form method='post' >";
    foreach($actors as $actor){
        $form .= "First Name: <input type='text' name='fname' value='".$actor['firstname']."'><br>
                  Last Name:  <input type='text' name='lname' value='".$actor['lastname']."'><br>
                  DOB:        <input type='text' name='dob' value='".$actor['dob']."'><br>
                  Height:     <input type='text' name='height' value='".$actor['height']."'><br>
                              <input type=\"submit\" name=\"action\" value=\"Update\">
                  ";
    }
    $form .= "</form>";
}else{
$form = "Life is sad lol, no actors 4 u";
}
echo $form;
}
catch(PDOException $e){
die("There was a problem retrieving the actors");
}?>
<?php
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$firstname = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING) ?? "";
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING) ?? "";
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
$height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";

switch ($action){
    case "Update":
    updateActor($db, $firstname, $lastname, $dob, $height, $id);
    break;
}

?>