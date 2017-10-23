<?php
//establishes a connection
function dbconn(){
    $dsn = "mysql:host=localhost;dbname=phpclassfall2017";
    $username = "root";
    $password = "";
    try{
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }catch(PDOException $e){
        die("There was a problem connecting to the database. See ur database admin pls thx");
    }
}