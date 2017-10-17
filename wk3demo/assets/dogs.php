<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 10/16/2017
 * Time: 12:15 PM
 */
function getDogsAsTable($db){
    try{$sql = $db->prepare("SELECT * FROM animals");
    $sql->execute();
    $dogs = $sql->fetchAll(PDO::FETCH_ASSOC);
    if($sql->rowCount() > 0){
        $table = "<table>" . PHP_EOL;
        foreach($dogs as $dog){
            $table .= "<tr><td>" . $dog['name'] . "</td><td>" . $dog['gender'] . "</td><td>" . $dog['fixed'] . "</td></tr>";
        }
        $table .= "</table>" . PHP_EOL;
    }else{
       $table = "Life is sad lol, no dogs 4 u";
    }
    return $table;
    }
    catch(PDOException $e){
        die("There was a problem retrieving the dogs");
    }
}
function addDog($db, $name, $gender, $fixed){
    try{
        $sql= $db->prepare("INSERT INTO animals VALUES (null, :name, :gender, :fixed");

        $sql = $db->prepare("INSERT INTO animals VALUES (null, :name, :gender, :fixed)");
        $sql->bindParam(':name', $name);
        $sql->bindParam(':gender', $gender);
        $sql->bindParam(':fixed', $fixed);
        $sql->execute();
        return $sql->rowCount();
    }catch(PDOException $e){
        die("There was a problem giving birth to the poppy");
    }
}