<?php
    include_once 'assets/layout/nav.php';
    require 'assets/dbconn.php';
    require 'assets/functions.php';
    ?>
<form action='' method='get'><?php dropdownCats(dbconn())?><input type='submit' name='sortMethod' value='Search'></form>
<?php
    if(isset($_GET['sortMethod'])){
        grabItemsByCol(dbconn(), $_GET['option']);
    }elseif(isset($_GET['itemID'])){

        grabSelectedItem(dbconn(), $_GET['itemID']);

    }else{
        grabAllItems(dbconn());
        //session_destroy();
    }

    if(isset($_GET['addCart'])){
        $cartItem = array('itemID'=>$_GET['itemID'], 'qty'=>0);
        if(!isset($_SESSION['cart'])){
            echo "SESSION CART CREATED";
            $_SESSION['cart'] = array();
            //adding item to cart vv
            $_SESSION['cart'][$_GET['itemID']]['qty'] = 1;
            echo "<div class='alert alert-success'>SUCCESS: Added item to cart!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            exit();
        }else{
            if(!isset($_SESSION['cart'][$_GET['itemID']])){
                echo "<div class='alert alert-success'>SUCCESS: Added item to cart!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                $_SESSION['cart'][$_GET['itemID']]['qty'] = 1;

            }else{
                echo "<div class='alert alert-success'>SUCCESS: Added item to cart!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                $_SESSION['cart'][$_GET['itemID']]['qty'] += 1;
            }






        }




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //ALL THE CODE BELOW IS TRASH CODE AND I STOOD UP UNTIL 2 IN THE MORNING TRYING TO FIGURE THAT OUT
        //NOW I KNOW SO I WRAPPED IT IN COMMENTS FOR MY VIEWING//



        /*if(!isset($_SESSION['cart'])){
            $itemAry = array(
                'itemID'=>$_GET['itemID'],
                'qty'=>1
            );
            $_SESSION['cart'] = array();
            array_push($_SESSION['cart'], $itemAry);
            echo "a new array pushed";
        }else{*/
            /*for ($i = 0; $i < count($_SESSION['cart']); $i++){

                if($_SESSION['cart'][$i]['itemID'] != $_GET['itemID']){
                    echo "_SESSION itemID Lizard should be 3: ".$_SESSION['cart'][6]['itemID'];
                    echo "_SESSION itemID: ".$_SESSION['cart'][$i]['itemID']."<br>";
                    echo "_GET itemID    : ".$_GET['itemID']."<br><br>";
                    echo "=============<br>quantity in cart: " . $_SESSION['cart'][$i]['qty']."<br>=============<br><br>";
                    $itemAry = array ('itemID' => $_GET['itemID'], 'qty' => 1);
                    array_push($_SESSION['cart'], $itemAry);
                    echo "a new array pushed<br><br>";

                }elseif($_SESSION['cart'][$i]['itemID'] == $_GET['itemID']) {
                    echo "_SESSION itemID: ".$_SESSION['cart'][$i]['itemID']."<br>";
                    echo "_GET itemID    : ".$_GET['itemID']."<br><br>";
                    echo "=============<br>quantity in cart: " . $_SESSION['cart'][$i]['qty']."<br>=============<br><br>";
                    $_SESSION['cart'][$i]['qty'] += 1;
                }
            }
            //print_r($_SESSION['cart']);
            //vvvvvvvvvvvvvvvvvvvvvvvv IT HAS SOMETHING TO DO WITH THIS vvvvvvvvvvvvvvvvvvvvvvvvvvvvv
            /*foreach($_SESSION['cart'] as $key=>&$val){
                echo "<pre>"; print_r($val); echo "</pre>";
                echo "<pre>"; print_r($_SESSION['cart'][$key]); echo "</pre>";
                if(findItem($_GET['itemID']) == true){
                    echo "<br>added one more to the cart";
                    $val['qty']+= 1;
                }elseif(findItem($_GET['itemID']) != true){
                    $itemAry = array(
                        'itemID'=>$_GET['itemID'],
                        'qty'=>1
                    );
                    echo "<br>nothing was found";
                    array_push($_SESSION['cart'], $itemAry);
                    exit();
                }
                if((int)$val['itemID'] == (int)$_GET['itemID']){
                    //echo "yes.";
                    $val['qty']+= 1;
                    echo $key." " .print_r($val)."<br>";
                    exit();
                }else{
                    if(findItem(1) == true){
                    }
                    if(!in_array((int)$val['itemID'], $_SESSION['cart'][$key])) {
                        array_push($_SESSION['cart'], $itemAry);
                    }
                }
                //$_SESSION['cart'] = array_unique($_SESSION['cart'][$key]['itemID']);
            }
            //$_SESSION['cart'] = array_unique($_SESSION['cart']);
        }
        //$_SESSION['cart'] = array_unique($_SESSION['cart'][$key]['itemID']);
        //print_r($_SESSION['cart']);

       */
    }
?>


