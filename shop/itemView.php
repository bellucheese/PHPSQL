<?php
    include_once 'assets/layout/nav.php';
    require 'assets/dbconn.php';
    require 'assets/functions.php';

    if(isset($_GET['itemID'])){
        grabSelectedItem(dbconn(), $_GET['itemID']);
    }else{
        grabAllItems(dbconn());
    }

    if(isset($_GET['addCart']) == true){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
            $itemAry = array('itemID'=>$_GET['itemID'],'qty'=>1);
            array_push($_SESSION['cart'], $itemAry);
        }else{
            foreach ($_SESSION['cart'] as $items){
                print_r($items);
                echo "<br><br>";
                echo $items['itemID']." ".$items['qty'];
                echo "<br><br>";
                if($items['itemID'] == $_GET['itemID']){
                    $_SESSION['cart'][$items['itemID']]['qty'] += 1;
                    echo "match found, value changed.";
                }else{
                    $itemAry = array('itemID'=>$_GET['itemID'],'qty'=>1);
                    array_push($_SESSION['cart'], $itemAry);
                }
                /*

                if($_GET['itemID'] == $id){

                }*/
            }
            $itemAry = array('itemID'=>$_GET['itemID'], 'qty'=>1);
            //array_push($_SESSION['cart'], $itemAry);
        }
        //print_r($itemAry);
        print_r($_SESSION['cart']);
        //session_destroy();
    }
?>


