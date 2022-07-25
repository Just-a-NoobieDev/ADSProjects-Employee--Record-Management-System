<?php 

require "../includes/db.php";


if($_POST['action'] == "register") {
    $username = capitalizeFirst($_POST['username']);
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    //echo $username, $email, $pass;

    if($pass == $cpass) {
        $check = "SELECT email FROM tbladminaccount WHERE email = '$email' GROUP BY email HAVING Count(email) > 0;";
        $r1 = mysqli_query($con, $check);
        
        if(mysqli_num_rows($r1) > 0) {
            echo 3;
        } else {
            $sql = "INSERT INTO tbladminaccount (username, email, pass) VALUES ('$username', '$email', '$pass');";
            $result = mysqli_query($con, $sql);
            if($result) {
                $username = "";
                $email = "";
                $pass = "";
                $cpass = "";
                echo 1;
            } else {
                echo $sql;
            }
        }      
    } else {
        echo 2;
    }

}
function capitalizeFirst($str) {
    $strlower = strtolower($str);
    $newstr = ucwords($strlower);
    return $newstr;
}
?>