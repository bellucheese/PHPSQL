<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 11/29/2017
 * Time: 1:47 PM
 */
//IF NOT LOGGED IN REDIRECT TO LOGIN
include_once 'assets/layout/nav.php';
require 'assets/dbconn.php';
require 'assets/functions.php';
if(isset($_GET['action']) == 'addedCat'){
    echo "<div class='alert alert-success'>SUCCESS: <b>Added</b> a new item!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

if(isset($_GET['action']) == 'updatedPro'){
    echo "<div class='alert alert-success'>SUCCESS: <b>Update</b> has been completed!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
if(isset($_GET['update']) == "success"){
    echo "<div class='alert alert-success'>SUCCESS: <b>Update</b> has been completed!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
if(isset($_POST['addCat'])){
    //ADD IF CATEGORY ALREADY EXISTS DON'T ADD AND WARN THE USER
    createCat(dbconn(), $_POST['catName']);
    header('Location: admin.php?action=addedCat');
}
if(isset($_GET['delete'])){
    deleteCat(dbconn(), $_GET['option']);
}

if(isset($_GET['delItem'])){
    deleteItem(dbconn(), $_GET['itemID']);
    echo "<div class='alert alert-success'>SUCCESS: <b>Deleted</b> an item!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
if(isset($_POST['addPro'])){
    if(empty($_POST['proName']) || empty($_POST['price'])){
        echo "<div class='alert alert-danger'>ERROR: One or more of the fields is not filled in.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }else {
        $nmeimage = $_FILES['productImage']['name'];
        $tmpimage = $_FILES['productImage']['tmp_name'];


        if (isset($nmeimage)) {
            if (!empty($nmeimage)) {
                if (move_uploaded_file($tmpimage, "assets/itemIMG/" . $nmeimage)) {
                    createPro(dbconn(), $_POST['option'], $_POST['proName'], $_POST['price'], $nmeimage);
                    header('Location: admin.php?action=addedPro');
                } else {
                    echo "An error occured.";
                }
            }
        } else {
            echo "Please choose an image to upload.";
        }
    }
}
?>

<h3>Management Tools</h3>
<hr>
<form method="get" action="">
    <?php
        dropdownCats(dbconn());
    ?>
    <input class='btn btn-primary' type="submit" name="edit" value="Edit"> <input class='btn btn-danger' type="submit" name="delete" value="Delete"> <input class='btn btn-secondary'type="submit" name="list" value="List"></form>

<hr>
<h5>Add a category</h5>
<form action='' method='post'>
    <label><b>Category Name:</b></label> <input type='text' name='catName' placeholder="Shirts"> <input class='btn btn-primary' type='submit' name='addCat' value='Add Category'>
</form>
<hr>
<h5>Add a Product</h5>
<form action='' method='post' enctype="multipart/form-data">
    <b>Product Name: </b> <input type='text' name='proName' placeholder="Rubber duck"><br>
    <b>Category: </b> <?php dropdownCats(dbconn());?><br>
    <b>Price: $</b><input type='number' name='price' placeholder='9.99' step=".01"><br>
    <b>Image: </b><input type='file' name='productImage'><br>
    <input class='btn btn-primary' type='submit' name='addPro' value='Add Product'>
</form>

<hr>

<?php
if(isset($_GET['list'])){
    itemList(dbconn(), $_GET['option']);
}
if(isset($_GET['udItem'])){
    updateItemForm(dbconn(),$_GET['itemID']);
}
if(isset($_GET['edit'])){
    updateCatForm(dbconn(), $_GET['option']);
}
if(isset($_POST['updateCategory'])){
    if(empty($_POST['category'])){
        echo "<div class='alert alert-danger'>ERROR: One or more of the fields is not filled in.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }else{
        @updateCat(dbconn(), $_POST['categoryID'], $_POST['category']);
    }
}
if(isset($_POST['updateItem'])){
    if(empty($_POST['product']) || empty($_POST['price'])){
        echo "<div class='alert alert-danger'>ERROR: One or more of the fields is not filled in.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }else {
        $nmeimage = $_FILES['image']['name'];
        $tmpimage = $_FILES['image']['tmp_name'];
        echo $nmeimage;

        if (isset($nmeimage)) {
            if (!empty($nmeimage)) {
                if (move_uploaded_file($tmpimage, "assets/itemIMG/" . $nmeimage)) {
                    updatePro(dbconn(), $_POST['option'], $_POST['product'], $_POST['price'], $_FILES['image']['name'], $_POST['productID']);

                } else {
                    echo "An error occured.";
                }
            }
        } else {
            echo "Please choose an image to upload.";
        }
    }
}

include_once 'assets/layout/footer.php';