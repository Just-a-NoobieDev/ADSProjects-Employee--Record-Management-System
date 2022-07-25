<?php
require "../includes/db.php";


if($_POST['action'] == 'show') {

    $empID = $_POST['id'];
    $company = $_POST['company'];

    if($company == 'CP1') {
        
        $sql = "SELECT b.*, a.*, c.* 
                FROM tblemployeedetails_companya a
                INNER JOIN tblemploymentdetails_companya c on a.EmpID = c.EmpID
                INNER JOIN tbldepartment b on c.DeptCode = b.DeptCode
                WHERE a.EmpID = '$empID';";

    } else {

        $sql = "SELECT b.*, a.*, c.* 
                FROM tblemployeedetails_companyb a
                INNER JOIN tblemploymentdetails_companyb c on a.EmpID = c.EmpID
                INNER JOIN tbldepartment b on c.DeptCode = b.DeptCode
                WHERE a.EmpID = '$empID';";

    }

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
    } else {
        echo 1;
    }

}

if(isset($_POST['gender']) && $_POST['action'] == 'update') {
    update();
}

function capitalizeFirst($str) {
    $strlower = strtolower($str);
    $newstr = ucwords($strlower);
    return $newstr;
}

function update() {
    global $con;
     
     $empID = capitalizeFirst($_POST['empID']);
     $fName = capitalizeFirst($_POST['fName']);
     $lName = capitalizeFirst($_POST['lName']);
     $mName = capitalizeFirst($_POST['mName']);
     $gender = $_POST['gender'];
     $email = $_POST['email'];
     $contactNo = $_POST['contactNo'];
     $dob = $_POST['dob'];
     $address = capitalizeFirst($_POST['address']);
     $deptCode = $_POST['deptCode'];
     $companyCode = $_POST['company'];
     $position = capitalizeFirst($_POST['position']);
     $jdate = $_POST['jdate'];

     if(empty($fName) || empty($lName) || empty($mName) || empty($gender) || empty($email) || empty($contactNo) || empty($dob) || empty($address) || empty($deptCode) || empty($companyCode) || empty($position) || empty($jdate)) {
        echo "";
        exit;
    }

    if($companyCode == 'CP1') {

        $queryPdetails = "UPDATE tblemployeeDetails_companya SET firstName = '$fName', lastName = '$lName', middleName = '$mName', gender = '$gender', email = '$email', contactNo = $contactNo, birthdate = '$dob', empAddress = '$address' WHERE EmpID = '$empID';";
        

    } else {
        $queryPdetails = "UPDATE tblemployeeDetails_companyb SET firstName = '$fName', lastName = '$lName', middleName = '$mName', gender = '$gender', email = '$email', contactNo = $contactNo, birthdate = '$dob', empAddress = '$address' WHERE EmpID = '$empID';";
        
    }
    mysqli_query($con, $queryPdetails);

    if($companyCode == 'CP1') {

        $queryEmploymentDetails = "UPDATE tblemploymentDetails_companya SET DeptCode = '$deptCode', position = '$position', employmentdate = '$jdate' WHERE EmpID = '$empID';";
    } else {
        $queryEmploymentDetails = "UPDATE tblemploymentDetails_companyb SET DeptCode = '$deptCode', position = '$position', employmentdate = '$jdate' WHERE EmpID = '$empID';";
    }
    mysqli_query($con, $queryEmploymentDetails);

    echo 1;

}



?>