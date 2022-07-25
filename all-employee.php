<?php
include "./includes/db.php"; 

session_start();

  if(!$_SESSION['user_id']) {
    header('Location: login.php');
  };
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is our final project in our subject Advance Database System">
    <meta name="keywords" content="ERMS, Employee Management, Employee Record, System, Database">

    <title>Employee Record Management System</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/nav-bar.css">
    <link rel="stylesheet" href="./style/sidebar.css">

    <!-- JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/index.js" defer></script>

  </head>

  <body>

    <?php
    include_once "./includes/sidebar.php";
    ?>

    <main>
      <?php 
        include_once "./includes/navbar.php";
      ?>

<div class="container">
        <div class="d-flex input justify-content-between px-3 mb-4">
            <input class="form-control mr-sm-2 search-input"  type="text"  id="live-search" placeholder="Search Employee (First Name or Last Name)" autocomplete="off">
            <div id="filters">
              <select name="filterval" id="filterval" class="custom-select">
                <option value="" selected disabled>Filter by</option>
                <option value="All" >All Employee</option>
        
                <!-- Start of PHP code to pull out departments name, position, company from department DB -->
                <?php 
        
                  $companyquery = "SELECT CompanyName FROM tblcompany;";
                  $company = mysqli_query($con, $companyquery);
        
                  echo '
                        <option value="" disabled></option>
                        <option value="" disabled>FILTER BY Company</option>
                    ';
        
                  while($row = mysqli_fetch_array($company)) {
                    echo '
                        <option id="option"  data-type="company" value="'.$row['CompanyName'].'">'.$row['CompanyName'].'</option>
                    ';
                  }
                
                  $query = 'SELECT DeptName FROM tbldepartment;';
                  $department = mysqli_query($con, $query);
        
                  echo '
                        <option value="" disabled></option>
                        <option value="" disabled>FILTER BY Department</option>
                    ';
        
                  while($row = mysqli_fetch_array($department)) {
                    echo '
                        <option id="option"  data-type="department" value="'.$row['DeptName'].'">'.$row['DeptName'].'</option>
                    ';
                  }
        
                  echo '
                        <option value="" disabled></option>
                        <option value="" disabled>FILTER BY Position</option>
                    ';
        
                  $positionquery = "SELECT DISTINCT position FROM tblemploymentDetails_companyA UNION SELECT DISTINCT position FROM tblemploymentDetails_companyB;";
                  $position = mysqli_query($con, $positionquery);
        
                  while($row = mysqli_fetch_array($position)) {
                    echo '
                        <option id="option"  data-type="position" value="'.$row['position'].'">'.$row['position'].'</option>
                    ';
                  }
        
                ?>
                <!-- End of PHP code to pull out departments name, position, company from department DB -->
                
              </select>
            </div>
        </div>
        <div class="table-container">    
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Employee ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th> 
                <th scope="col">Company</th>
                <th scope="col">Department</th>
                <th scope="col">Position</th>
                </tr>
            </thead>
            <tbody>

              <!-- Start of PHP code to pull out data all from DB -->
                <?php 

                  $query1 = 'SELECT companyA.EmpID, companyA.firstName, companyA.lastName, tbldepartment.DeptName, tblcompany.companyName, b.position 
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

                  

                  $result = mysqli_query($con, $query1);

                  while($row = mysqli_fetch_array($result)) {
                    echo '
                    
                        <tr>
                            <td>'.$row['EmpID'].'</td>
                            <td>'.$row['firstName'].'</td>
                            <td>'.$row['lastName'].'</td>
                            <td class="text-center">'.$row['companyName'].'</td>
                            <td>'.$row['DeptName'].'</td>
                            <td>'.$row['position'].'</td>
                        </tr>
                    ';
                  }

                ?>

                <!-- End of PHP code to pull out all data from DB -->
                
            </tbody>
        </table>
        </div>
      </div>
      
    </main>

     


    <script type="text/javascript">
        $(document).ready(function() {
          $('#filterval').on('change', function() {
            let value = $(this).val();

                $.ajax({
                  url:"./functions/filterby.php",
                  type: "POST",
                  data: "request=" + value,
                  beforeSend: function() {
                    $(".table-container").html("<span>Working...</span>")
                  },
                  success: function(data) {
                    $(".table-container").html(data)
                  }
                });

            });
            
        });

        $(document).ready(function() {
          $('#live-search').keyup('click', function() {
            let input = $(this).val();
            //alert(value);


              $.ajax({
                url:"./functions/search.php",
                type: "POST",
                data: {input:input},
                success: function(data) {
                  $(".table-container").html(data)
                }
              });

          });
        });
    </script>
  </body>
</html>