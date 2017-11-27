<html>
<head>

</head>
<body>
<a href="index.php">Site Entry</a> || <a href="listing.php">Site Listing</a>
<form action="#" method="post">
    <input type="text" name="site" placeholder="Ex: https://google.com">
    <input type="submit" name="submit" value="Submit">
</form>
<?php
include 'assets/add.php';
require 'assets/dbconn.php';

/**
 * Created by PhpStorm.
 * User: bellu
 * Date: 11/8/2017
 * Time: 2:22 PM
 */
if(isset($_POST['submit'])){

    if(empty($_POST['site'])){
        echo "The site field is empty, please fill it in.";
    }
    else{
        if(!preg_match("/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/",$_POST['site'])){
            echo "Please enter a valid website in the proper format. Ex: https://www.google.com/";
        }else{
            $sitesFound = siteFind(dbconn(),$_POST['site']);
            if($sitesFound == 0) {
                $sites = array();
                $file = file_get_contents($_POST['site']);
                echo "<b>" . preg_match_all("/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/", $file, $matches, PREG_OFFSET_CAPTURE) . " link(s) found for </b>\"<a href='" . $_POST['site'] . "'>" . $_POST['site'] . "</a>\"<br><hr>";
                preg_match_all("/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/", $file, $matches, PREG_OFFSET_CAPTURE);
                foreach ($matches as $match) {
                    foreach ($match as $m) {
                        array_push($sites, $m[0]);
                        echo "<a href='".$m[0]."'>".$m[0] . "</a><br>";
                    }
                }
                addSite(dbconn(), $_POST['site'], $sites);
            }else{
                echo $_POST['site']." already exists in the database<br>";
                echo $sitesFound;
            }
        }
    }
}
?>
</body>
</html>
