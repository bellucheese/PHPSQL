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

function createCat($db, $catName){
    try{
        $sql = $db->prepare("INSERT INTO categories VALUES (null, :catName)");
        $sql->bindParam(":catName", $catName);
        $sql->execute();
        return $sql->rowCount();
    }
    catch(PDOException $e){
        echo $e;
        die("There was a problem");
    }
}

function dropdownCats($db){
    try{
        $sql = $db->prepare("SELECT * FROM categories");
        $sql->execute();
        $cats = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0){
            $select = "<select name='option'>" . PHP_EOL;
            foreach($cats as $cat){
                $select .= "<option>".$cat['category']."</option>";
            }
            $select .= "</select>";
        }else{
            $select = "Life is sad lol, no sites 4 u";
        }
        echo $select;
    }
    catch(PDOException $e){
        die("There was a problem retrieving the category");
    }
}

function deleteCat($db, $cat){
    try{
        $sql = $db->prepare("DELETE FROM categories WHERE category=:cat");
        $sql->bindParam(":cat", $cat);
        $sql->execute();
    }
    catch(PDOException $e){
        die("There was a problem deleting the Category");
    }
}

