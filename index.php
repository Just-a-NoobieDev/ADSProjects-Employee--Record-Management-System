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
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/nav-bar.css">

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

        <h1>WELCOME <?php echo $_SESSION['username'] ?></h1>
        <div class="w-100 p-4">
          <?php 
            $query1 = "SELECT Count(*) FROM `tblemployeedetails_companya`";
            $result1 = mysqli_query($con, $query1);
            $countID1 = $result1->fetch_array()[0] ?? '0';
          ?>
          <div class="d-flex mb-5">
            <div class="container w-25 card bg-dark mt-3">
              <h3 class="text-title">Total Employees in Company A:</h3>
              <p class="number "><?php echo $countID1 ?></p>
            </div>
            <?php 
              $query2 = "SELECT Count(*) FROM `tblemployeedetails_companyb`";
              $result2 = mysqli_query($con, $query2);
              $countID2 = $result2->fetch_array()[0] ?? '0';
            ?>
            <div class="container w-25 card bg-dark mt-3">
              <h3 class="text-title">Total Employees in Company B:</h3>
              <p class="number "><?php echo $countID2 ?></p>
            </div>
          </div>
          <div class="d-flex card-container">
            <?php 
              $query3 = "SELECT SUM(tbl.eachtablecount) from (SELECT Count(*) as eachtablecount FROM tblemploymentdetails_companya WHERE DeptCode = 'CS' UNION ALL SELECT Count(*) as eachtablecount FROM tblemploymentdetails_companyb WHERE DeptCode = 'CS')tbl;";
              $result3 = mysqli_query($con, $query3);
              $countID3 = $result3->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm card shadow rounded mt-3">
              <h3 class="text-title text-dark">Total Customer Service Employees:</h3>
              <p class="number text-dark"><?php echo $countID3 ?></p>
            </div>
            <?php 
              $query4 = "SELECT SUM(tbl.eachtablecount) from (SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companya` WHERE DeptCode = 'FA' UNION ALL SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companyb` WHERE DeptCode = 'FA')tbl;";
              $result4 = mysqli_query($con, $query4);
              $countID4 = $result4->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm shadow rounded mt-3 card">
              <h3 class="text-title text-dark">Total Finance and Accounting Employees:</h3>
              <p class="number mt-1 mb-1 text-dark"><?php echo $countID4 ?></p>
            </div>
            <?php 
              $query5 = "SELECT SUM(tbl.eachtablecount) from (SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companya` WHERE DeptCode = 'FM' UNION ALL SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companyb` WHERE DeptCode = 'FM')tbl;";
              $result5 = mysqli_query($con, $query5);
              $countID5 = $result5->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm card shadow rounded mt-3">
              <h3 class="text-title text-dark">Total Facility Management Employees:</h3>
              <p class="number mt-0 text-dark"><?php echo $countID5 ?></p>
            </div>
            <?php 
              $query6 = "SELECT SUM(tbl.eachtablecount) from (SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companya` WHERE DeptCode = 'HR' UNION ALL SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companyb` WHERE DeptCode = 'HR')tbl;";
              $result6 = mysqli_query($con, $query6);
              $countID6 = $result6->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm card shadow rounded mt-3">
              <h3 class="text-title text-dark">Total Human Resource Employees:</h3>
              <p class="number pt-1 text-dark"><?php echo $countID6 ?></p>
            </div>
            
            <?php 
              $query7 = "SELECT SUM(tbl.eachtablecount) from (SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companya` WHERE DeptCode = 'IT' UNION ALL SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companyb` WHERE DeptCode = 'IT')tbl;";
              $result7 = mysqli_query($con, $query7);

              $countID7 = $result7->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm shadow rounded mt-3 card">
              <h3 class="text-title text-dark">Total IT Personnel Employees:</h3>
              <p class="number pt-2 text-dark"><?php echo $countID7 ?></p>
            </div>
            <?php 
              $query8 = "SELECT SUM(tbl.eachtablecount) from (SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companya` WHERE DeptCode = 'MD' UNION ALL SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companyb` WHERE DeptCode = 'MD')tbl;";
              $result8 = mysqli_query($con, $query8);
              $countID8 = $result8->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm card shadow rounded mt-3">
              <h3 class="text-title text-dark">Total Marketing Department Employees:</h3>
              <p class="number mt-0 text-dark"><?php echo $countID8 ?></p>
            </div>
            <?php 
              $query9 = "SELECT SUM(tbl.eachtablecount) 
              from (SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companya` WHERE DeptCode = 'OM' UNION ALL SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companyb` WHERE DeptCode = 'OM')tbl;";
              $result9 = mysqli_query($con, $query9);
              $countID9 = $result9->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm card shadow rounded mt-3">
              <h3 class="text-title text-dark">Total Operations Management Employees:</h3>
              <p class="number mt-0 text-dark"><?php echo $countID9 ?></p>
            </div>
            <?php 
              $querya = "SELECT SUM(tbl.eachtablecount) from (SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companya` WHERE DeptCode = 'SD' UNION ALL SELECT Count(*) as eachtablecount FROM `tblemploymentdetails_companyb` WHERE DeptCode = 'SD')tbl;";
              $resulta = mysqli_query($con, $querya);
              $countIDa = $resulta->fetch_array()[0] ?? '0';
            ?>
            <div class="container-sm shadow rounded mt-3 card">
              <h3 class="text-title text-dark">Total Sales Department Employees:</h3>
              <p class="number mt-0 text-dark"><?php echo $countIDa ?></p>
            </div>
          </div>
              <div class="container mt-5 w-75">
                <h4>Department with 2 or more Male employee</h4>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Department</th>
                        <th scope="col">Count</th>

                        </tr>
                    </thead>
                    <tbody>

                      <!-- Start of PHP code to pull out data all from DB -->
                        <?php 
                          $query1 = "SELECT b.DeptCode, count(a.gender) as eachtables, a.gender
                                    FROM tblemployeedetails_companya a
                                    LEFT JOIN `tblemploymentdetails_companya` b on a.EmpID = b.EmpID
                                    WHERE gender = 'male'
                                    UNION
                                    SELECT b.DeptCode, count(a.gender) as eachtables, a.gender
                                    FROM tblemployeedetails_companyb a
                                    LEFT JOIN `tblemploymentdetails_companyb` b on a.EmpID = b.EmpID
                                    WHERE gender = 'male'
                                    GROUP BY Gender, DeptCode
                                    HAVING eachtables >= 2;";

                          

                          $result = mysqli_query($con, $query1);

                          while($row = mysqli_fetch_array($result)) {
                            echo '
                            
                                <tr>
                                    <td>'.$row['DeptCode'].'</td>
                                    <td>'.$row['eachtables'].'</td>
                                </tr>
                            ';
                          }

                        ?>

                    <!-- End of PHP code to pull out all data from DB -->
                    
                </tbody>
            </table>
          </div>

           <div class="container mt-5 mb-5 w-75">
                <h4>Department with 2 or more Female employee</h4>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Department</th>
                        <th scope="col">Count</th>

                        </tr>
                    </thead>
                    <tbody>

                      <!-- Start of PHP code to pull out data all from DB -->
                        <?php 

                          $query1 = "SELECT b.DeptCode, count(a.gender) as eachtables, a.gender
                                    FROM tblemployeedetails_companya a
                                    LEFT JOIN tblemploymentdetails_companya b on a.EmpID = b.EmpID
                                    WHERE gender = 'female'
                                    UNION
                                    SELECT b.DeptCode, count(a.gender) as eachtables, a.gender
                                    FROM tblemployeedetails_companyb a
                                    LEFT JOIN `tblemploymentdetails_companyb` b on a.EmpID = b.EmpID
                                    WHERE gender = 'female'
                                    GROUP BY Gender, DeptCode
                                    HAVING eachtables >= 2;";

                          

                          $result = mysqli_query($con, $query1);

                          while($row = mysqli_fetch_array($result)) {
                            echo '
                            
                                <tr>
                                    <td>'.$row['DeptCode'].'</td>
                                    <td>'.$row['eachtables'].'</td>
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

    

  </body>
</html>