<?php 

require("../includes/db.php");


if($_POST['action'] == 'retrieve') {

    $empID = $_POST['id'];
    $company = $_POST['company'];

    if($company == 'CP1') {
        
        $sql = "SELECT b.*, a.*, c.*, d.* 
                FROM tblemployeedetails_companya a
                INNER JOIN tblemploymentdetails_companya c on a.EmpID = c.EmpID
                INNER JOIN tbldepartment b on c.DeptCode = b.DeptCode
                INNER JOIN tblcompany d on c.CompanyCode = d.CompanyCode
                WHERE a.EmpID = '$empID';";

    } else {

        $sql = "SELECT b.*, a.*, c.*, d.* 
                FROM tblemployeedetails_companyb a
                INNER JOIN tblemploymentdetails_companyb c on a.EmpID = c.EmpID
                INNER JOIN tbldepartment b on c.DeptCode = b.DeptCode
                INNER JOIN tblcompany d on c.CompanyCode = d.CompanyCode
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
?>