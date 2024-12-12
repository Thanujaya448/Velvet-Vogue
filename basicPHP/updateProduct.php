
<?php 

include './functions.php'; //basic functions

if(isset($_POST['Type']) && isset($_POST['ProID']))
{
    $proID = $_POST['ProID'];
    $getSql = "SELECT * FROM product WHERE pid = '$proID'";

    $temp = dbFunction($getSql);

    

    if(mysqli_num_rows($temp) > 0)
    {
        $row = mysqli_fetch_assoc($temp);

        $response = [

            "pid" => $row['pid'],
            "category" => $row['category'],
            "brand" => $row['brand'],
            "product_Name" => $row['product_Name'],
            "review" => $row['review'],
            "price" => $row['price'],
            "img1" => $row['img1'],
            "img2" => $row['img2'],
            "img3" => $row['img3'],
            "img4" => $row['img4'],
            "hasOptions" => $row['hasOptions'],
            "options" => $row['options'],
            "weightRange" => $row['weightRange'],
            "packageSize" => $row['packageSize'],
            "netWeight" => $row['netWeight'],
            "material" => $row['material'],
            "hasDescription" => $row['hasDescription'],
            "description" => $row['description']
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else
    {
        $response = [
            "ErrMsg" => "We can't find any product with that Product ID!..."
        ];
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    

}

//print_r($_POST);

?>



