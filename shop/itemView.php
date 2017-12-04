<?php
    include_once 'assets/layout/nav.php';
    require 'assets/dbconn.php';
    require 'assets/functions.php';

    if(isset($_GET['itemID'])){
        grabSelectedItem(dbconn(), $_GET['itemID']);
    }else{
        grabAllItems(dbconn());
    }
?>


