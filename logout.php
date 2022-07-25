<?php 

session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
header("location: login.php");
die();

?>