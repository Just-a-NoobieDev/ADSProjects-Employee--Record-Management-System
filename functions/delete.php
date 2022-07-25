<?php 

include "../includes/db.php";


if(isset($_POST['empID'])) {
    $empID = $_POST['empID'];
    $company = $_POST['company'];

    if($company == 'CP1') {

        $valid = "SELECT EmpID FROM tblemployeedetails_companyA WHERE EmpID = '$empID';";
    } else {
        
        $valid = "SELECT EmpID FROM tblemployeedetails_companyB WHERE EmpID = '$empID';";
    }
    $validity = mysqli_query($con, $valid);
    $result = $validity->fetch_array()['EmpID'] ?? '';

    if($result !== "") {

        if($company == 'CP1') {

            $find = "DELETE FROM tblemployeedetails_companyA WHERE EmpID = '$empID';";
        } else {
            $find = "DELETE FROM tblemployeedetails_companyB WHERE EmpID = '$empID';";

        }

        if(mysqli_query($con, $find)) {
            echo 1;
        } else {
            echo 3;
        }

    } else {
        echo 2;
    }

}

?>