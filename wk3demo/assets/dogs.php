<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 10/16/2017
 * Time: 12:15 PM
 */
function getDogsAsTable($db){
    $sql = $db->prepare("SELECT * FROM animals");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}