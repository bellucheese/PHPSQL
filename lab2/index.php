<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 2 | PHP</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #808080">
    <?php
        include_once 'assets/nav.html';
    ?>
    <div class="wrapper">
        <div class="section" style="background-color: #fff;
    border-radius: 10px; padding-top: 10px;padding-bottom: 10px;">
            <h1 class="page-title">Actors</h1>
            <?php
                include_once 'assets/dbconn.php';
                include_once 'assets/actors.php';
                echo getActorsAsTable(dbconn());
            ?>
        </div>
    </div>
</body>
</html>