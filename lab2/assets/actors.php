<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 10/16/2017
 * Time: 12:15 PM
 */
function getActorsAsTable($db){
    try{$sql = $db->prepare("SELECT * FROM actors");
        $sql->execute();
        $actors = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0){
            $table = "<table class='table table-striped'>" . PHP_EOL;
            $table .= "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Height</th></tr>";
            foreach($actors as $actor){
                $table .= "<tr><td>".$actor['id']."</td><td>" . $actor['firstname'] . "</td><td>" . $actor['lastname'] . "</td><td>" . $actor['dob'] . "</td><td>".$actor['height']."</td></tr>";
            }
            $table .= "</table>" . PHP_EOL;
        }else{
            $table = "Life is sad lol, no actors 4 u";
        }
        return $table;
    }
    catch(PDOException $e){
        die("There was a problem retrieving the actors");
    }
}

function getActorsAsTablev2($db){
    try{$sql = $db->prepare("SELECT * FROM actors");
        $sql->execute();
        $actors = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0){
            $table = "<table class='table table-striped'>" . PHP_EOL;
            $table .= "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Height</th><th>Edit</th><th>Delete</th></tr>";
            foreach($actors as $actor){

                $table .= "<tr><td>".$actor['id']."</td><td>" . $actor['firstname'] . "</td><td>" . $actor['lastname'] . "</td><td>" . $actor['dob'] . "</td><td>".$actor['height']."</td><td><a href='assets/edit.php?id=".$actor['id']."'>Edit</a></td><td><a href='assets/delete.php?id=".$actor['id']."'>Delete</a></td></tr>";
            }
            $table .= "</table>" . PHP_EOL;
        }else{
            $table = "Life is sad lol, no actors 4 u";
        }
        return $table;
    }
    catch(PDOException $e){
        die("There was a problem retrieving the actors");
    }
}

function addActor($db, $firstname, $lastname, $dob, $height){
    try{
        $sql = $db->prepare("INSERT INTO actors VALUES (null, :firstname, :lastname, :dob, :height)");
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);
        $sql->execute();
        return $sql->rowCount();
    }catch(PDOException $e){
        die("There was a problem giving birth to the actor lol");
    }
}

function updateActor($db, $firstname, $lastname, $dob, $height, $id){
    try{
        $sql = $db->prepare("UPDATE `actors` SET `firstname`=:firstname,`lastname`=:lastname,`dob`=:dob,`height`=:height WHERE id = :id;");
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->rowCount();
    }catch(PDOException $e){
        die("There was a problem editing the actor");
    }
}

