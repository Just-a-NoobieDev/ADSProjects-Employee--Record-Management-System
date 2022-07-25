<?php 
 include './includes/db.php';

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

    <title>ERMS | Add Employee</title> 

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
     include_once('./includes/sidebar.php');
     ?>

      <main>

        <?php
          include_once('./includes/navbar.php');
         ?>

      <div class="add-form">
        <h2 class="section-title mb-4">ADD NEW EMPLOYEE</h2>

        <div class="container add-form-div w-100 shadow rounded ">
          <form id="add-emp" class="d-flex flex-column px-3" action="" method="POST">
            <div class="p-details mb-4">
              <h3 class="mt-3 py-3">Personal Details</h3>
              <div class="vertical mb-2">
                <div class="form-group w-50 mr-2">
                  <label for="firstName" >First Name</label>
                  <input type="text" name="firstName" class="form-control" required>
                </div>
                <div class="form-group w-50 mr-2">
                  <label for="lastName" >Last Name</label>
                  <input type="text" name="lastName" class="form-control" required>
                </div>
                <div class="form-group w-50">
                  <label for="middleName" >Middle Name</label>
                  <input type="text" name="middleName" class="form-control" required>
                </div>            
              </div>

              <div class="vertical">
                <div class="px-2 w-25">
                  <label for="gender" class="d-block">Gender</label>
                  <!-- custom-control custom-radio custom-control-inline -->
                  <div class=" mr-6 ">
                    <!-- class="custom-control-input" -->
                    <input type="radio" name="gender" value="Male"  required>
                    <!-- class="custom-control-label" -->
                    <label  for="gender">
                      Male
                    </label>
                  </div>
                  <!-- custom-control custom-radio custom-control-inline -->
                  <div class=" ml-3"> 
                    <!-- class="custom-control-input" -->
                    <input type="radio" name="gender"  value="Female">
                    <!-- class="custom-control-label" -->
                    <label  for="gender">
                      Female
                    </label>
                  </div>
                </div>
                <div class="form-group w-50">
                    <label for="email" >Email</label>
                    <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
                </div>
                <div class="form-group w-25 ml-4">
                    <label for="contactNo">Contact Number</label>
                    <input type="text" name="contactNo" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                </div>
              </div>

              <div class="vertical">
                <div class="form-group w-25 ml-4">
                  <label for="birthdate" >Date of Birth</label>
                  <input type="date" id="dob" name="birthdate" class="form-control" required>
                </div>
                <div class="form-group w-50 ml-4">
                  <label for="address" >Address</label>
                  <input type="text" name="address" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="employment-details mb-5">
              <h3 class="py-3">Employment Details</h3>
              <div class="vertical px-3 mt-3">
                
                <div class="dept-list d-flex flex-column">
                  <label for="dept-list-code">Department Code</label>
                  <select name="dept-code" class="custom-select" id="department-code" required>
                    <option value="" hidden selected>Choose Department</option>
                    <!-- Start of PHP code to pull out departments name from department DB -->
                    <?php            
                      $query = 'SELECT DeptCode FROM tbldepartment;';
                      $department = mysqli_query($con, $query);

                      while($row = mysqli_fetch_array($department)) {
                        echo '
                            <option id="option" value="'.$row['DeptCode'].'">'.$row['DeptCode'].'</option>
                        ';
                      }
                    ?>
                    <!-- End of PHP code to pull out departments name from department DB -->             
                  </select>
                </div>

                <div class="dept-list d-flex flex-column ml-2">
                  <label for="dept-list">Company Code</label>
                  <select name="company-code" class="custom-select" id="company-code" required>
                    <option value="" hidden selected></option>
                    <!-- Start of PHP code to pull out departments name from department DB -->
                    <?php            
                      $query = 'SELECT CompanyCode FROM tblcompany;';
                      $company = mysqli_query($con, $query);

                      while($row = mysqli_fetch_array($company)) {
                        echo '
                            <option id="option" value="'.$row['CompanyCode'].'">'.$row['CompanyCode'].'</option>
                        ';
                      }
                    ?>
                    <!-- End of PHP code to pull out departments name from department DB -->             
                  </select>
                </div>

              </div>

              <div class="vertical px-3 mt-3">
                <div class="form-group mb-0 ml-2 w-50">
                  <label for="position" >Position</label>
                  <input type="text" name="position" class="form-control" required>
                </div>
                <div class="form-group mb-0 ml-2 w-50">
                  <label for="jdate" >Joining Date</label>
                  <input type="date" id="jdate" class="form-control" required>
                </div>
              </div>
            </div>

            <button class="mb-4 btn-submit" type="submit" id="submit-data" >Submit</button>
          </form>
        </div>
        <div class="container b"><p>   </p></div>
      </main>
      </div>
      
      
      <script type="text/javascript">

        $(document).ready(function() {
          $('#submit-data').on('click', function(e) {
            e.preventDefault();

            var bdate = new Date($('#dob').val());
            var bday = bdate.getDate();
            var bmonth = bdate.getMonth() + 1;
            var byear = bdate.getFullYear();

            var dob = [byear, bmonth, bday].join('-');

            var jdate = new Date($('#jdate').val());
            var jday = jdate.getDate();
            var jmonth = jdate.getMonth() + 1;
            var jyear = jdate.getFullYear();

            var jdate = [jyear, jmonth, jday].join('-');


            $.ajax({

              url: './functions/insert-into.php',
              type: 'POST',
              data: {
                fName: $("input[name = 'firstName']").val(),
                lName: $("input[name='lastName']").val(),
                mName: $("input[name='middleName']").val(),
                Gender: $("input[name='gender']:checked").val(),
                email: $("input[name='email']").val(),
                contactNo: $("input[name='contactNo']").val(),
                dob: dob,
                address: $("input[name='address']").val(),
                deptCode: $("select[name='dept-code']").val(),
                CompanyCode: $("select[name='company-code']").val(),
                position: $("input[name='position']").val(),
                jdate: jdate,
                annualSalary: $("input[name='annual-salary']").val(),
                monthlySalary: $("input[name='monthly-salary']").val(),
                action: "insert"
              },
              success: function(response) {
                console.log(response)
                if(response == 1) {
                  swal({
                    title: "Success",
                    text: "New Employee Added.",
                    icon: "success",
                    button: "close"
                  })
                } else {
                  swal({
                    title: "Error",
                    text: "Something went wrong. Contact the owner of this website.",
                    icon: "error",
                    button: "close"
                  })
                }
              }
            })
          })
        })
    

      </script>
      <script src="./js/sweetalert.js"></script>
  </body>
</html>