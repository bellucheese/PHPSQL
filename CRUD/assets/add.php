<?php

function addCorp($db, $corp, $email, $zipcode, $owner, $phone){
    try{
        $sql = $db->prepare("INSERT INTO corps() VALUES (null, :corp, now(), :email, :zipcode, :owner, :phone)");
        $sql->bindParam(':corp', $corp);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return $sql->rowCount();
    }catch(PDOException $e){
        die("There was a problem giving birth to the corp lol");
    }
}