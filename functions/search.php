<?php

include("../includes/db.php");


if(isset($_POST['input'])) {

    $filtervalues = $_POST['input'];

    if($_POST['input'] = "") {
        $query = 'SELECT companyA.EmpID, companyA.firstName, companyA.lastName, tbldepartment.DeptName, tblcompany.companyName, b.position 
        FROM tblemployeedetails_companya companyA
        INNER JOIN tblemploymentdetails_companya b ON companyA.EmpID = b.EmpID  
        INNER JOIN tbldepartment ON tbldepartment.DeptCode = b.DeptCode
        INNER JOIN tblcompany ON tblcompany.Companycode = b.companyCode
        UNION
        SELECT companyB.EmpID, companyB.firstName, companyB.lastName, tbldepartment.DeptName, tblcompany.companyName, c.position 
        FROM tblemployeedetails_companyb companyB
        INNER JOIN tblemploymentdetails_companyb c ON companyB.EmpID = c.EmpID 
        INNER JOIN tbldepartment ON tbldepartment.DeptCode = c.DeptCode 
        INNER JOIN tblcompany ON tblcompany.CompanyCode = c.CompanyCode 
        ORDER BY EmpID ASC;';
    } else {
        $query = "SELECT companyA.EmpID, companyA.firstName, companyA.lastName, tbldepartment.DeptName, tblcompany.companyName, b.position 
        FROM tblemployeedetails_companya companyA
        INNER JOIN tblemploymentdetails_companya b ON companyA.EmpID = b.EmpID  
        INNER JOIN tbldepartment ON tbldepartment.DeptCode = b.DeptCode
        INNER JOIN tblcompany ON tblcompany.Companycode = b.companyCode  
        WHERE CONCAT(firstName, ' ', lastName, ' ', middleName) LIKE '%$filtervalues%' 
        UNION
        SELECT companyB.EmpID, companyB.firstName, companyB.lastName, tbldepartment.DeptName, tblcompany.companyName, c.position 
        FROM tblemployeedetails_companyb companyB
        INNER JOIN tblemploymentdetails_companyb c ON companyB.EmpID = c.EmpID 
        INNER JOIN tbldepartment ON tbldepartment.DeptCode = c.DeptCode 
        INNER JOIN tblcompany ON tblcompany.CompanyCode = c.CompanyCode 
        WHERE CONCAT(firstName, ' ', lastName, ' ', middleName) LIKE '%$filtervalues%' 
        ORDER BY  EmpID ASC;";
    }



    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);


?>

<table class="table table-bordered">
    <?php

    if($count) {

    

    ?>
        <thead class="thead-dark">
            <tr>
            <th scope="col">Employee ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Company Name</th>
            <th scope="col">Department</th>
            <th scope="col">Position</th>
            </tr>
        

    <?php 

    } else {

        echo "Sorry no record Found";

    }
    ?>
    </thead>

    <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)) {
                echo '
                        <tr>
                            <td>'.$row['EmpID'].'</td>
                            <td>'.$row['firstName'].'</td>
                            <td>'.$row['lastName'].'</td>
                            <td>'.$row['companyName'].'</td>
                            <td>'.$row['DeptName'].'</td>
                            <td>'.$row['position'].'</td>
                        </tr>
                    ';
            }
        ?>
    </tbody>

</table>
<?php
}
?>
