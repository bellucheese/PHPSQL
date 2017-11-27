<html>
<head>

</head>
<body>
<a href="index.php">Site Entry</a> || <a href="listing.php">Site Listing</a>
<form action="#" method="post">
        <?php
            include 'assets/add.php';
            require 'assets/dbconn.php';
            grabSitesDropDown(dbconn());
        ?>
    <input type="submit" name="submit" value="Submit">
</form>
<?php
    if(isset($_POST['submit'])){
        grabSites(dbconn(),$_GET['option']);
    }
?>
</body>
</html>
