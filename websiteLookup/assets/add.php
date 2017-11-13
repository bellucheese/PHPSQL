<?php
//adds to sites
function addSite($db, $site, $sites){
    try{
        $sql = $db->prepare("INSERT INTO sites VALUES (null,:site, now())");
        $sql->bindParam(':site', $site);
        $sql->execute();
        $siteID = $db->lastInsertId();
        foreach($sites as $link){
            $sql = $db->prepare("INSERT INTO sitelinks VALUES (:siteID, :link)");
            $sql->bindParam(':link',$link);
            $sql->bindParam(':siteID', $siteID);
            $sql->execute();
        }
        return $sql->rowCount();
    }catch(PDOException $e){
        echo $e;
        die("There was a problem giving birth to the site lol");
    }
}
