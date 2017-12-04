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
if(isset($_GET['action']) == 'added'){
    echo "<div class='alert alert-success'>SUCCESS: <b>Added</b> a new category!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
if(isset($_POST['addCat'])){
    //ADD IF CATEGORY ALREADY EXISTS DON'T ADD AND WARN THE USER
    createCat(dbconn(), $_POST['catName']);
    header('Location: admin.php?action=added');
}
if(isset($_GET['delete'])){
    deleteCat(dbconn(), $_GET['option']);
}
?>

<h3>Management Tools</h3>
<hr>
<form method="get" action="">
    <?php
        dropdownCats(dbconn());
    ?>
    <input class='btn btn-primary' type="submit" name="edit" value="Edit"> <input class='btn btn-danger' type="submit" name="delete" value="Delete"> <input class='btn btn-secondary'type="button" name="list" value="List"></form>

<hr>
<h5>Add a category</h5>
<form action='' method='post'>
    <label><b>Category Name:</b></label> <input type='text' name='catName' placeholder="Shirts"> <input class='btn btn-primary' type='submit' name='addCat' value='Add Category'>
</form>
<hr>
<h5>Add a Product</h5>
<form action='' method='post'>
    <b>Product Name: </b> <input type='text' name='catName' placeholder="Rubber duck"><br>
    <b>Category: </b> //Create dropdown of categories here in a function<br>
    <b>Price: $</b><input type='number' name='price' placeholder='9.99'><br>
    <b>Image: </b><input type='file' name='productImage'><br>
    <input class='btn btn-primary' type='submit' name='addPro' value='Add Product'>
</form>

<hr>
//list out all products here when list is pressed
<?php


include_once 'assets/layout/footer.php';