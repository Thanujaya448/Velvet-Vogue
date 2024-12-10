<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "velvet_vogue";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





//connect to Database
function dbFunction($tempSQL)
{
    //$con = mysqli_connect("localhost", "root", "", "velvet_vogue", "3306");
    global $conn;
    
    if (!$conn){
        die("Sorry, you can't connect into the database.");
    }

    $sql = $tempSQL;

    return mysqli_query($conn, $sql);;
}




?>
