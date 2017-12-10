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


function itemList($db, $cat){
    try{

        $sql = $db->prepare("SELECT * FROM categories WHERE category=:cat");
        $sql->bindParam(":cat", $cat);
        $sql->execute();
        $categoryIDs = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($categoryIDs as $cats){
            $catID = $cats['category_id'];


        }
        $sql = $db->prepare("SELECT * FROM products WHERE category_id=:id");
        $sql->bindParam(":id", $catID);
        $sql->execute();

        $itemInfo = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = "<table class='table table-striped'>";
        $output .= "<tr><th>Product Name</th><th>Category</th><th>Price</th><th>Image</th><th>Modifiers</th></tr>";
        foreach($itemInfo as $info){
            $output .= "<tr><td>".$info['product']."</td><td>".catFind(dbconn(),$info['category_id'])."</td><td>".$info['price']."</td><td><img style='width: auto; height: 35px; ' src='assets/itemIMG/".$info['image']."'></td><td><a class='btn btn-primary' href='admin.php?udItem=true&itemID=".$info['product_id']."'>Update</a> <a class='btn btn-danger' href='admin.php?delItem=true&itemID=".$info['product_id']."'>Delete</a></td></tr>";
        }
        $output .= "</table>";
        echo $output;


    }catch(PDOException $e){
        echo $e;
        die("problem lol");
    }
}

function updateItemForm($db, $itemID){
    try{

        $sql = $db->prepare("SELECT * FROM products WHERE product_id=:itemID");
        $sql->bindParam(":itemID", $itemID);
        $sql->execute();
        $itemInfo = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = "<table class='table table-striped'>";
        $output .= "<tr><th>Product ID</th><th>Product Name</th><th>Category</th><th>Price</th><th>Image</th><th>Submit</th></tr>";
        foreach($itemInfo as $info){
            $output .= "<form method='post' action='' enctype='multipart/form-data'>";
            $output .= "<tr><td><input type='text' name='productID' value='".$info['product_id']."' readonly></td><td><input type='text' name='product' value='".$info['product']."'></td><td>".dropCats(dbconn())."</td><td>$<input type='number' name='price' placeholder='9.99' step='.01' value='".$info['price']."'></td><td><input type='file' name='image'></td><td><input class='btn btn-primary' type='submit' name='updateItem' value='Update'></td></tr>";
            $output .= "</form>";
        }
        $output .= "</table>";
        echo $output;


    }catch(PDOException $e){
        echo $e;
        die("problem lol");
    }
}


function updateCatForm($db, $category){
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
        $sql = $db->prepare("SELECT * FROM categories WHERE category_id=:catID");
        $sql->bindParam(":catID", $catID);
        $sql->execute();
        $itemInfo = $sql->fetchAll(PDO::FETCH_ASSOC);

        $output = "<table class='table table-striped'>";
        $output .= "<tr><th>Category ID</th><th>Category Name</th><th>Submit</th></tr>";
        foreach($itemInfo as $info){
            $output .= "<form method='post' action='admin.php?update=success' enctype='multipart/form-data'>";
            $output .= "<tr><td><input type='text' name='categoryID' value='".$info['category_id']."' readonly></td><td><input type='text' name='category' value='".$info['category']."'></td><td><input class='btn btn-primary' type='submit' name='updateCategory' value='Update'></td></tr>";
            $output .= "</form>";
        }
        $output .= "</table>";
        echo $output;


    }catch(PDOException $e){
        echo $e;
        die("problem lol");
    }
}

function updatePro($db, $category, $proName, $price, $imgURL, $itemID){
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
        $sql = $db->prepare("UPDATE products SET category_id=:catID, product=:proName, price=:price, image=:imgURL WHERE product_id=:itemID");
        $sql->bindParam(":catID", $catID);
        $sql->bindParam(":proName", $proName);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":imgURL", $imgURL);
        $sql->bindParam(":itemID", $itemID);
        $sql->execute();
        return $sql->rowCount();
    }
    catch(PDOException $e){
        echo $e;
        die("There was a problem");
    }
}

function updateCat($db, $catID, $category){
    try{
        $sql = $db->prepare("UPDATE categories SET category=:category WHERE category_id=:catID");
        $sql->bindParam(":catID", $catID);
        $sql->bindParam(":category", $category);
        $sql->execute();
        header("Location: admin.php?update=success");
        return $sql->rowCount();
    }
    catch(PDOException $e){
        echo $e;
        die("There was a problem");
    }
}

function grabItemsByCol($db, $cat){
    try{

        $sql = $db->prepare("SELECT * FROM categories WHERE category=:cat");
        $sql->bindParam(":cat", $cat);
        $sql->execute();
        $categoryIDs = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($categoryIDs as $cats){
            $catID = $cats['category_id'];


        }
        $sql = $db->prepare("SELECT * FROM products WHERE category_id=:id");
        $sql->bindParam(":id", $catID);
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

function catFind($db, $catID){
    try{
        $sql = $db->prepare("SELECT * FROM categories WHERE category_id=:catID");
        $sql->bindParam(':catID', $catID);
        $sql->execute();
        $catInfo = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($catInfo as $cat){
            $echoOutput = $cat['category'];
        }

        return $echoOutput;
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
function dropCats($db){
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
        return $select;
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
function deleteItem($db, $pro){
    try{
        $sql = $db->prepare("DELETE FROM products WHERE product_id=:pro");
        $sql->bindParam(":pro", $pro);
        $sql->execute();
    }
    catch(PDOException $e){
        die("There was a problem deleting the Product");
    }
}


