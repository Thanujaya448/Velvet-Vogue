<?php 

session_start();

include './basicPHP/functions.php'; //basic functions
include 'db.php';


    // change cart amount realtime
    if (isset($_POST['QNT']) && isset($_POST['proID']) && isset($_POST['userID']) && isset($_POST['Appro'])) {

        $totalPrice;
        $Qnt = (int)$_POST['QNT'];

            $sql = "SELECT * FROM products WHERE id = '{$_POST['proID']}'";
            $updateQntSql = "UPDATE cartitems SET quantity = '{$_POST['QNT']}' WHERE uid = '{$_POST['userID']}' AND pid = '{$_POST['proID']}'";
            $result = dbFunction($sql);
            $AssArr = mysqli_fetch_assoc($result);


            $UnitPrice = (float)$AssArr['price'];

        if(isset($_POST['Appro']))
        {
            $totalPrice = $Qnt * $UnitPrice;
            dbFunction($updateQntSql);

            echo priceFormat($totalPrice);
        }
        

    }
    



    //add single item to cart using cart icon
    if(isset($_POST['proIDof1Item']) && isset($_POST['imgPath1Item']) && isset($_POST['userID1Item']))
    {
        $proID = $_POST["proIDof1Item"];
        $userID = $_POST['userID1Item'];
        $imgLink = $_POST['imgPath1Item'];

        $tempSql_1 = "SELECT * FROM cartitems WHERE uid = '$userID' AND pid = '$proID'";  //get current data from db


        //get all items
        $resultAllCart = dbFunction($tempSql_1);
        

        if(mysqli_num_rows($resultAllCart) > 0)
        {
            $type = "old";
        }
        else{
            $type = "new";
        }

        if($type == "new")
         {
            $tempSql_2 = "INSERT INTO `cartitems` (`uid`, `pid`, `quantity`, `image`) VALUES ('$userID', '$proID', '1', '$imgLink')";
         }
        else if($type == "old")
         {

            $sql_count = "SELECT * FROM cartitems WHERE uid = '$userID' AND pid = '$proID'";
            $row1 = mysqli_fetch_assoc(dbFunction($sql_count));


            $newcount = (int)$row1['quantity'];

            $newVal =  $newcount += 1;

            $tempSql_2 = "UPDATE `cartitems` SET `quantity` = '$newVal' WHERE uid = '$userID' AND pid = '$proID'";
         }

        $saveItemtoCart =  dbFunction($tempSql_2);
    }



    // remove item from db

    if(isset($_POST['deleteUID']) && isset($_POST['deletePID']))
    {
        $dUID = $_POST['deleteUID'];
        $dPID = $_POST['deletePID'];

        $tempSql3 = "DELETE FROM cartitems WHERE uid = '$dUID' and pid = '$dPID'"; //delete product from the database

        $resultDelete = dbFunction($tempSql3);

        if($resultDelete)
        {
            echo "Item Deleted";
        }
    }




    //calculate totol for each user
    if(isset($_GET['UID']))
    {
        $total = 0;
        $tax = 0;
        $shipping = 0;
        $shippingTxt;
        $subTotal = 0;

        $tempSql4 = "SELECT * FROM cartitems WHERE uid = '{$_GET['UID']}'";

        $cartResult = dbFunction($tempSql4);

        while($cartQun = mysqli_fetch_assoc($cartResult))
        {
            $tempPID = $cartQun['pid'];
            $tempSql5 = "SELECT * FROM products WHERE id = '{$cartQun['pid']}'";
            $productResult = dbFunction($tempSql5);

            while($itemPrice = mysqli_fetch_assoc($productResult))
            {
                $subTotal += floor((int)$cartQun['quantity'] * (float)$itemPrice['price'] * 100) / 100;
            }
        }

        $tax = floor(($subTotal * 0.18) * 100) / 100;

        switch($subTotal)
        {
            case ($subTotal + $tax) < 50 :
                $shipping = 0;
            break;
            case ($subTotal + $tax) < 500 :
                $shipping = floor(($subTotal) * 0.05 * 100) / 100;
            break;
            case ($subTotal + $tax) < 1500 :
                $shipping = floor(($subTotal) * 0.08 * 100) / 100;
            break;
            default:
                $shipping = floor(($subTotal) * 0.10 * 100) / 100;
            break;
        }

        $total = $subTotal + $tax + $shipping;

        //saving data to database

        $sql1 = "SELECT * FROM carttotal WHERE uid = '{$_SESSION['user_id']}'"; // difining table
        $sql2 = "INSERT INTO `carttotal` (`uid`, `subtotal`, `tax`, `shipping`, `total`) VALUES ('{$_SESSION['user_id']}', '$subTotal', '$tax', '$shipping', '$total')";
        $sql3 = "UPDATE carttotal SET uid = '{$_SESSION['user_id']}', subtotal = '$subTotal', tax = '$tax', shipping = '$shipping', total = '$total' WHERE uid = '{$_SESSION['user_id']}'";

        $totalResult = dbFunction($sql1);

        updateOrInsert($totalResult, $sql2, $sql3);



        //formatting the values
        $total = priceFormat($total);
        $tax = priceFormat($tax);

        if($subTotal > 50)
        {
            $shippingTxt = priceFormat($shipping);
        }
        else
        {
            $shippingTxt = "Free Shipping";
        }

        $subTotal = priceFormat($subTotal);


        //creating JSON

        $response = [

            "subtotal" => $subTotal,
            "tax" => $tax,
            "shippinginfo" => $shippingTxt,
            "total" => "<strong>".$total."</strong>"
        ];

        //sending data as jason
        header('Content-Type: application/json');
        echo json_encode($response);

    }
    

    