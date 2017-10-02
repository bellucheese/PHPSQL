<?php
    $table = "<table>";
    for($rows = 1; $rows <=9; $rows++){
        $table .= "\n<tr>\n";
            for($cols = 1; $cols <=9; $cols++) {
                $table .= "\t<td>". $rows * $cols."</td>\n";
            }
        $table .= "</tr>\n";
    }
    $table .= "</table>\n";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php echo $table; ?>
</body>
</html>