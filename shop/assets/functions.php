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

function grabSelectedItem($db, $itemID){
    try{
        $sql = $db->prepare("SELECT * FROM products WHERE product_id=:id");
        $sql->bindParam(":id", $itemID);
        $sql->execute();

        $itemInfo = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = "";
        foreach($itemInfo as $info){
            $output .= "<h2>".$info['product']."</h2><hr>";
            $output .= "<img src='assets/itemIMG/".$info['image']."' style='max-width: 500px;'><br>";
            $output .= "<b>Price:</b> $". $info['price'];
            $output .= "<br><h3><a href='itemView.php?addCart=true&itemID=".$info['product_id']."'>Add to cart</a></h3>";
            //$output .= "<form method='get' action=''><input type='submit' class='btn btn-primary' value='Add to Cart' name='addCart'></form>";
        }
        echo $output;

    }catch(PDOException $e){
        echo $e;
        die("problem lol");
    }
}

function grabAllItems($db){
    try{
        $sql = $db->prepare("SELECT * FROM products");
        $sql->execute();

        $cardInfo = $sql->fetchAll(PDO::FETCH_ASSOC);

        //print_r($cardInfo);



        $cardOutPut = "";
        $oddEven = 0;
        //$cardOutPut .= "<div class='row'>";
        foreach($cardInfo as $info){

            $cardOutPut .= "<div class='card'><img class='card-img-top img-fluid' src='assets/itemIMG/".$info['image']."' style='height: 400px; object-fit: cover;'>";
            $cardOutPut .= "<div class='card-body'><h4 class='card-title'>".$info['product']."</h4>";
            $cardOutPut .= "<a href='itemView.php?itemID=".$info['product_id']."' class='btn btn-primary'>View item</a> <span style='float: right; font-weight: bold; font-size: 16px' class='text-right text-primary'>$".$info['price']."</span>";
            $cardOutPut .= "</div></div><br>";

        }
        echo $cardOutPut;

    }catch(PDOException $e){
        echo $e;
        die("problem lol");
    }
}
function outputItemCard($db, $itemID){
    try{
        $sql = $db->prepare("SELECT * FROM products WHERE product_id=:itemID");
        $sql->bindParam(':itemID', $itemID);
        $sql->execute();

        $cardInfo = $sql->fetchAll(PDO::FETCH_ASSOC);

        //print_r($cardInfo);

        $cardOutPut = "<div class='col-sm-6'><div class='card'>";
        foreach($cardInfo as $info){
            $cardOutPut .= "<img src='assets/itemIMG/".$info['image']."' style='height: 400px; object-fit: cover;'>";
            $cardOutPut .= "<div class='card-body'><h4 class='card-title'>".$info['product']."</h4>";
            $cardOutPut .= "<a href='itemView.php?ID=".$info['product_id']."' class='btn btn-primary'>View item</a> <span style='float: right; font-weight: bold; font-size: 16px' class='text-right text-primary'>$".$info['price']."</span>";
            $cardOutPut .= "</div></div></div>";
        }
        echo $cardOutPut;

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

function createPro($db, $category, $proName, $price, $imgURL){
    try{
        $sql = $db->prepare("SELECT * FROM categories WHERE category=:category");
        $sql->bindParam(":category", $category);
        $sql->execute();
        $catIDs = $sql->fetchAll(PDO::FETCH_ASSOC);
        $catID = 0;
        if($sql->rowCount() > 0){
            foreach($catIDs as $catsID){
                $catID = $catsID['category_id'];
            }
        }
        $sql = $db->prepare("INSERT INTO products VALUES (null, :catID, :proName, :price, :imgURL)");
        $sql->bindParam(":catID", $catID);
        $sql->bindParam(":proName", $proName);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":imgURL", $imgURL);
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
            $select = "No categories to select from at this time, please add one.";
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

