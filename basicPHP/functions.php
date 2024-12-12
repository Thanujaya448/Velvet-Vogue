<?php 

//return value with corrected price format
function priceFormat($value)
{
    $tP = $value;
    settype($tP, "string");

    $arr = array();

    while(strlen($tP) > 3)
    {
        $arr[] = substr($tP, -3);
        $tP = substr($tP, 0, -3);
    }
    $arr[] = $tP;

    $arrLen = count($arr); //get length of array
    $rep = $arrLen - 1;

    $finalPrice = "";

    for($i = $rep; $i >= 0; $i--)
    {
        if($i != 0)
        {
            $finalPrice .= $arr[$i];
        }
        else
        {
            $finalPrice .= $arr[$i];
        }
        
    }

    return "$ ".$finalPrice;
}


//function that determite if needs to update or insert
function updateOrInsert($sql1, $insertSql, $updateSql)
{
    if(mysqli_num_rows($sql1) > 0)
        {
            $type = "old";
        }
        else{
            $type = "new";
        }

        if($type == "new")
         {
            $tempSql_2 = $insertSql;
         }
        else if($type == "old")
         {
            $tempSql_2 = $updateSql;
         }

        dbFunction($tempSql_2);
}


//function that get max pid from database
function getMaxPid()
{
    $sqlMax = "SELECT MAX(pid) AS maxPID FROM product";
    $resMax = dbFunction($sqlMax);
    $pidArr = mysqli_fetch_assoc($resMax);

    return $pidArr['maxPID'];
}


//function check if that pid avaiable in the db
function checkPID($tempPID)
{
    $sqlTempPID = "SELECT * FROM product WHERE pid = '$tempPID'";
    $resCheck = dbFunction($sqlTempPID);

    if(mysqli_num_rows($resCheck) > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}


//this will select 4 random numbers and send to client side
function selectRandom4($currentPID)
{
    $maxPID = getMaxPid();
    $control = 0;
    $numArr = array();


    while($control < 4)
    {
        $randomNumber = rand(1, $maxPID);

        if($randomNumber != $currentPID && checkPID($randomNumber) && !in_array($randomNumber, $numArr))
        {
            $numArr[] = $randomNumber;
            $control++;
        } 

    }

    return $numArr;
}