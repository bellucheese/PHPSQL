<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 11/27/2017
 * Time: 3:30 PM
 */
function userFind($db, $email){
    try{
        $sql = $db->prepare("SELECT Count(*) FROM users WHERE email=:email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        $numRows = $sql->fetchColumn();
        return $numRows;
    }catch(PDOException $e){
        echo $e;
        die("problem lol");
    }
}

function registerUser($db, $email, $password){
    try{
        $sql = $db->prepare("INSERT INTO users VALUES (null,:email, :password, now())");
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $password);
        $sql->execute();
        return $sql->rowCount();
    }catch(PDOException $e){
        echo $e;
        die("There was a problem giving birth to the user");
    }
}