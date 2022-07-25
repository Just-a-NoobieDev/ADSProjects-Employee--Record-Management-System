<?php

    $host = "localhost";
    $username = "root";
    $pass = "";
    $dbname= "erms";


    $con = mysqli_connect($host, $username, $pass, $dbname);

    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }



?>
