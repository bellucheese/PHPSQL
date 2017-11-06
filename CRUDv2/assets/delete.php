<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 10/22/2017
 * Time: 10:59 PM
 */

include 'dbconn.php';
//Connects to the DB and deletes via sql
$db = dbconn();
$id = $_GET['id'];
$sql = $db->prepare("DELETE FROM corps WHERE id=$id;");
$sql->execute();

header('Location: ../update.php');