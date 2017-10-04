<!doctype html>
<html>
    <body style="margin: 0; padding: 0; font-family: Calibri; font-weight: bold;">
    <?php
    $outputVariable = "<table style='min-width: 100vw; min-height: 100vh;'><tbody>";
    for($row = 0; $row <= 9; $row++ ){
        $outputVariable .= "<tr>";
        for($col = 0; $col <= 9; $col++){
            $randNumStr = "";
            for($i = 0; $i < 6; $i++) {
                $randHex = dechex(rand(0, 15));
                $randNumStr .= $randHex;
            }
            $outputVariable .= "<td style='background-color: #$randNumStr; width: 10% height: 10%; text-align: center; vertical-align: middle; border-radius: 10px;'>#$randNumStr<br><span style='color: white'>#$randNumStr</span></td>";
        }
        $outputVariable .= "</tr>";
    }
    $outputVariable .= "</tbody></table>";
    echo $outputVariable;
    ?>
</body>
</html>