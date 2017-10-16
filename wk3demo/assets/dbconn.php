<?php
/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 10/16/2017
 * Time: 12:07 PM
 */
function dbconn(){
    $dsn = "mysql:host=localhost;dbname=dogs";
    $username = "dogs";
    $password = "se266";
    try{
        $db = new PDO($dsn, $username, $password);
        return $db;
    }catch(PDOException $e){
        die("There was a problem connecting to the database. See ur database admin pls thx");
    }
}