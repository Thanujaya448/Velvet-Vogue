<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['uid']);
//session_destroy();
$_SESSION['userType'] = 'new';
header("Location: ../index.php");

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>alert("Logged out Succesfully");</script>
</body>
</html> -->

