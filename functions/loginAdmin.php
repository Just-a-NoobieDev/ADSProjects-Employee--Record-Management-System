<?php 
require '../includes/db.php';


if($_POST['action'] == "login") {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $query = "SELECT * FROM tbladminaccount WHERE email = '$email' AND pass = '$pass';";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $path = $_SERVER['localhost']. '/employee-management-system';
        header("Location: $path/index.php");
    } else {
       echo 1;
    }

}

?>