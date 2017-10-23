<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 10/22/2017
 * Time: 10:59 PM
 */

$id = $_GET['id'];
    $sql = $db->prepare("DELETE FROM actors WHERE id=$id;");
    $sql->execute();

header('Location: modify.php');