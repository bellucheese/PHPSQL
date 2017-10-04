<!doctype html>
<html>
    <body style="margin: 0; padding: 0; font-family: Calibri; font-weight: bold;">
    <?php
    //My output variable
    $outputVariable = "<table style='min-width: 100vw; min-height: 100vh;'><tbody>";
    //For loop to loop rows
    for($row = 0; $row <= 9; $row++ ){
        $outputVariable .= "<tr>";
        //for loop to loop columns
        for($col = 0; $col <= 9; $col++){
            //String to store the random hex values
            $randNumStr = "";
            //Generates the random hex values
            for($i = 0; $i < 6; $i++) {
                $randHex = dechex(rand(0, 15));
                $randNumStr .= $randHex;
            }
            //outputs all of the stuff to create the table data
            $outputVariable .= "<td style='background-color: #$randNumStr; width: 10% height: 10%; text-align: center; vertical-align: middle; border-radius: 10px;'>#$randNumStr<br><span style='color: white'>#$randNumStr</span></td>";
        }
        $outputVariable .= "</tr>";
    }
    $outputVariable .= "</tbody></table>";
    //Echos to the user
    echo $outputVariable;
    ?>
</body>
</html>