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
function siteFind($db, $site){
    try{
        $sql = $db->prepare("SELECT Count(*) FROM sites WHERE site=:site");
        $sql->bindParam(':site', $site);
        $sql->execute();
        $numRows = $sql->fetchColumn();
        return $numRows;
    }catch(PDOException $e){
        echo $e;
        die("There was a problem finding the site lol");
    }
}



///////////////////////////////////////////////////////////////////////////////////////////////////////


function grabSitesDropDown($db){
    try{
        $sql = $db->prepare("SELECT * FROM sites");
        $sql->execute();
        $sites = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0){
            $select = "<select name='option'>" . PHP_EOL;
            foreach($sites as $site){
                $select .= "<option>".$site['site']."</option>";
            }
            $select .= "</select>";
        }else{
            $select = "Life is sad lol, no sites 4 u";
        }
        echo $select;
    }
    catch(PDOException $e){
        die("There was a problem retrieving the sites");
    }
}


///////////////////////////////////////////////////////////////////////////////////////////////////////


function grabSites($db, $option){
    try{
        $sql = $db->prepare("SELECT site_id, date FROM sites WHERE site=:option");
        $sql->bindParam(":option",$option);
        $sql->execute();

        $sites = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($sites as $site){
            echo $sql->rowCount()." link(s) found for ".$option.", stored on ".$site['date']."<hr>";
            $siteID = $site['site_id'];
        }
        $sql = $db->prepare("SELECT * FROM sitelinks WHERE site_id=:site_id");
        $sql->bindParam(":site_id",$siteID);
        $sql->execute();
        $sites = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($sites as $site){
            echo "<a href='".$site['link']."'>".$site['link']."</a><br>";
        }
    }
    catch(PDOException $e){
        die("There was a problem retrieving the sites");
    }
}