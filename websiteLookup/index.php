<?php
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
            echo "The website was correctly typed.";
            //finish the rest of your project bitch. thx.
        }
    }
}
?>

<html>
<head>

</head>
<body>
<form action="#" method="post">
    <input type="text" name="site" placeholder="Ex: https://google.com">
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
