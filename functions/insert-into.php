<?php 
require "../includes/db.php";


if(isset($_POST['Gender']) && $_POST['action'] == "insert") {
    insert();
}



function capitalizeFirst($str) {
    $strlower = strtolower($str);
    $newstr = ucwords($strlower);
    return $newstr;
}

function insert() {
     global $con;
     
     $fName = capitalizeFirst($_POST['fName']);
     $lName = capitalizeFirst($_POST['lName']);
     $mName = capitalizeFirst($_POST['mName']);
     $gender = $_POST['Gender'];
     $email = $_POST['email'];
     $contactNo = $_POST['contactNo'];
     $dob = $_POST['dob'];
     $address = capitalizeFirst($_POST['address']);
     $deptCode = $_POST['deptCode'];
     $companyCode = $_POST['CompanyCode'];
     $position = capitalizeFirst($_POST['position']);
     $jdate = $_POST['jdate'];



    if(empty($fName) || empty($lName) || empty($mName) || empty($gender) || empty($email) || empty($contactNo) || empty($dob) || empty($address) || empty($deptCode) || empty($companyCode) || empty($position) || empty($jdate)) {
        echo "";
        exit;
    }

    
    if($companyCode == 'CP1') {

        $queryPdetails = "INSERT INTO tblemployeedetails_companya (firstName, lastName, middleName, gender, email, contactNo, birthdate, empAddress) VALUES ('$fName', '$lName', '$mName', '$gender', '$email', $contactNo, '$dob', '$address');";
        

    } else {
        $queryPdetails = "INSERT INTO tblemployeedetails_companyb (firstName, lastName, middleName, gender, email, contactNo, birthdate, empAddress) VALUES ('$fName', '$lName', '$mName', '$gender', '$email', $contactNo, '$dob', '$address');";
        
    }
    mysqli_query($con, $queryPdetails);

    if($companyCode == 'CP1') {
        
        $selectNewID = "SELECT EmpID FROM tblemployeedetails_companya ORDER BY EmpID DESC LIMIT 1;";
    } else {
        
        $selectNewID = "SELECT EmpID FROM tblemployeedetails_companyb ORDER BY EmpID DESC LIMIT 1;";
        
    }
    $result = mysqli_query($con, $selectNewID);
    $lastID = $result->fetch_array()['EmpID'] ?? '';
    //echo $lastID;

    if($companyCode == 'CP1') {

        $queryEmploymentDetails = "INSERT INTO tblemploymentdetails_companya VALUES($lastID, '$companyCode', '$deptCode', '$position', '$jdate');";
    } else {
        $queryEmploymentDetails = "INSERT INTO tblemploymentdetails_companyb VALUES($lastID, '$companyCode', '$deptCode', '$position', '$jdate');";
        

    }
    mysqli_query($con, $queryEmploymentDetails);

    echo 1;
}

?>

