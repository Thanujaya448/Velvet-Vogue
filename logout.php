<?php
session_start();
session_destroy();
header("Location: join.php");
exit;
?>
