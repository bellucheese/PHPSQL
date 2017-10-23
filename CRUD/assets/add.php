<?php
//adds to corp
function addCorp($db, $corp, $email, $zipcode, $owner, $phone){
    try{
        $sql = $db->prepare("INSERT INTO corps VALUES (null, :corp, now(), :email, :zipcode, :owner, :phone)");
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
//Modifies corp
function modCorp($db, $corp, $email, $zipcode, $owner, $phone, $id){
    try{
        //echo $corp . $email . $zipcode . $owner . $phone;
        //echo $id;
        $sql = $db->prepare("UPDATE corps SET corp=:corp, incorp_dt=now(), email=:email, zipcode=:zipcode, owner=:owner, phone=:phone WHERE id=:id");
        //echo $sql->rowCount();
        $sql->bindParam(':corp', $corp);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->bindParam(':id', $id);
        $sql->execute();
        //echo $sql->rowCount();
        //header('Location: update.php');
    }catch(PDOException $e){
        echo $e;
        die("There was a problem giving birth to the corp lol");
    }
}