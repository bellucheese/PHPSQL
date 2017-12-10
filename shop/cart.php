<?php
/**
 * Created by PhpStorm.
 * User: Drew
 * Date: 12/9/2017
 * Time: 12:33 AM
 */

include_once 'assets/layout/nav.php';
require 'assets/dbconn.php';
require 'assets/functions.php';
if(isset($_GET['action']) == 'delete'){
    unset($_SESSION['cart'][$_GET['itemID']]);
    echo "<div class='alert alert-danger'>DELETED: Your item has been removed from the cart.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
if(isset($_GET['add']) == 'true'){

    $_SESSION['cart'][$_GET['itemID']]['qty'] += 1;
    echo "<div class='alert alert-success'>UPDATE: Your item has been updated accordingly<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

if(isset($_GET['minus']) == true){
    if($_SESSION['cart'][$_GET['itemID']]['qty'] != 1){
        $_SESSION['cart'][$_GET['itemID']]['qty'] -= 1;
        echo "<div class='alert alert-success'>UPDATE: Your item has been updated accordingly<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }else{
        echo "<div class='alert alert-warning'>WARNING: You cant go below 1 item, if you'd like to remove it, please just press the remove button.
<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
}
$output = "<h3>Cart</h3><hr>";
$output .= "<table class='table table-hover'>";
$output .= "<tr><th>Product</th><th>Category</th><th>Price</th><th>Quantity</th></tr>";
$price = 0;
foreach($_SESSION['cart'] as $key=>&$val){
    try{
        $sql = dbconn()->prepare("SELECT * FROM products WHERE product_id=:key");
        $sql->bindParam(':key', $key);
        $sql->execute();
        $itemInfo = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($itemInfo as $item){
            //echo "<pre>".print_r($item)."</pre>";
            $price += ($val['qty'] * $item['price']);
            $output .= "<tr>";
            $output .= "<td>".$item['product']."</td>";
            $output .= "<td>".catFind(dbconn(),$item['category_id'])."</td>";
            $output .= "<td>$".($item['price']*$val['qty'])."</td>";
            $output .= "<td><a class='btn btn-primary' href='cart.php?minus=true&itemID=".$item['product_id']."'>-</a> ".$val['qty']." <a class='btn btn-primary' href='cart.php?add=true&itemID=".$item['product_id']."'>+</a></td>";
            $output .= "<td><a class='btn btn-danger' href='cart.php?action=remove&itemID=".$item['product_id']."'>Remove</a></td>";
            $output .= "</tr>";
        }


    }catch(PDOException $e){
        echo $e;
        die("failed to retrieve cart items");
    }
}
$output .= "<tr><th colspan='2'>Subtotal:</th><td colspan='2'>$$price</td></tr>";
$output .= "<tr><th colspan='2'>Taxes:</th><td colspan='2'>$".round($price*.07, 2)."</td></tr>";
$finalPrice = ($price*.07)+$price;
$output .= "<tr><th colspan='2'>Total:</th><td colspan='2'>$".round($finalPrice, 2)."</td></tr>";
$output .= "</table>";

echo $output;