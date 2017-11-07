<?php
session_start();
if($_SESSION['username'] == NULL || !isset($_SESSION['username'])){
    header('Location: foo2.php');
}
echo "Logged in as ".$_SESSION['username']."<br><br>";

/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 11/6/2017
 * Time: 11:36 AM
 */
$file = file_get_contents("https://www.cnn.com/");

echo preg_match_all("/Trump/",$file, $matches, PREG_OFFSET_CAPTURE);

print_r($matches);
//$greps = preg_grep("/Trump/", $file);
/*grabbing a primary key for a foreign key reference
$db = get my db
$sql = "INSERT INT foo VALUES (null, 'anrew','brllu');
$stmt = $db->prepare($sql);
bind params as necessary
$stmt->execute();
$pk $db->lastInsertId(); // will get me the last primaru key inserted

*/


$pwd = "foo";
$hash = password_hash($pwd, PASSWORD_DEFAULT);
echo $hash;

echo password_verify("foo", $hash);
//pretend PW HASH CAME FROM DB













