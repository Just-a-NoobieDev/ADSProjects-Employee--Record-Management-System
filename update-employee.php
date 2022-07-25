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

    <title>ERMS | Update Employee</title> 

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
     include_once('./includes/sidebar.php');
     ?>

      <main class="update">

      <?php
        include_once('./includes/navbar.php');
      ?>

      <div class="id-form">
        <h2 class="section-title mb-4">UPDATE EMPLOYEE DETAILS</h2>
        <div class="container w-75 delete shadow rounded d-flex align-items-center view-div">
          <form class="w-100 mt-3 p-2" action="" method="POST">
            <div class="form-group mb-0 ml-2">
              <div class="dept-list d-flex flex-column">
                <label for="dept-list">Company Code</label>
                <select name="company-code" class="custom-select mb-4" id="company-code" required>
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
              <label for="position" >Enter Employee ID</label>
              <input type="text" name="empid" class="form-control mb-3 mt-2" required>
              <button class="mb-4 btn-submit w-100" type="submit" name="button1" id="btn1" >FETCH DETAILS</button>
            </div>
          </form>
        </div>
      </div>

      <div class="modal fade " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
          <div class="modal-content md1">
            <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">UPDATE EMPLOYEE</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="add-emp" class="d-flex flex-column px-3" action="" method="POST">
                <div class="p-details mb-4">
                  <h3 class="mt-3 py-3">Personal Details</h3>
                  <div class="vertical mb-2 d-flex">
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

                  <div class="vertical d-flex">
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
                        <input type="text" name="contactNo" class="form-control" required>
                    </div>
                  </div>

                  <div class="vertical d-flex">
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
                  <div class="vertical px-3 mt-3 d-flex">
                    
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
                      <label for="dept-list">Department</label>
                      <select name="dept-name" class="custom-select" id="department-name" required>
                        <option value="" hidden selected>Choose Department</option>
                        <!-- Start of PHP code to pull out departments name from department DB -->
                        <?php            
                          $query = 'SELECT DeptName FROM tbldepartment;';
                          $department = mysqli_query($con, $query);

                          while($row = mysqli_fetch_array($department)) {
                            echo '
                                <option id="option" value="'.$row['DeptName'].'">'.$row['DeptName'].'</option>
                            ';
                          }
                        ?>
                        <!-- End of PHP code to pull out departments name from department DB -->             
                      </select>
                    </div>

                  </div>

                  <div class="vertical px-3 mt-3 d-flex">
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
                <button class="mb-4 btn-submit" type="submit" name="button" onclick="update()">Update</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      </main>

      
      
      
      <script type="text/javascript">

        $(document).ready(function () {
          $("#btn1").on('click', function(e) {
            e.preventDefault();

            var id = $("input[name='empid']").val();
            var company = $("select[name='company-code']").val();

            if(id !== "" && company !== "") {
              $.ajax({
                url: "./functions/updateEmployee.php",
                type: "POST",
                dataType: 'json',
                data: {
                  id: id,
                  company: company,
                  action: 'show'
                },
                success: function(response) {
                  if(response == 1) {
                    swal({
                      title: "Error",
                      text: "Employee ID not exist",
                      icon: "error",
                      button: "close"
                    })   
                  } else {
                    $('#staticBackdrop').modal('show');
                    var data = response;

                    $("input[name = 'firstName']").val(data[3])
                    $("input[name='lastName']").val(data[4])
                    $("input[name='middleName']").val(data[5])
                    $("input[name='gender']").val(data[6]).attr("checked",true).trigger("change")
                    $("input[name='email']").val(data[7])
                    $("input[name='contactNo']").val(data[8])
                    $('#dob').val(data[9])
                    $("input[name='address']").val(data[10])
                    $("select[name='dept-code']").val(data[13]).prop("selected",true).trigger("change")
                    $("select[name='dept-name']").val(data[1]).prop("selected",true).trigger("change")
                    $("input[name='position']").val(data[14])
                    $('#jdate').val(data[15])

                  }
                }
              })
            } else {
              swal({
                title: "Error",
                text: "Please enter employee id or select company code",
                icon: "error",
                button: "close"
              })
            }
          })

        })

        let form = document.getElementById("add-emp");
        function handleForm(event) {
          event.preventDefault();
        }
        form.addEventListener('submit', handleForm)

        


        function update() {
          $(document).ready(function() {
        
            var bdate = new Date($('#dob').val());
            var bday = bdate.getDate();
            var bmonth = bdate.getMonth();
            var byear = bdate.getFullYear();

            var dob = [byear, bmonth, bday].join('-');

            var jdate = new Date($('#jdate').val());
            var jday = jdate.getDate();
            var jmonth = jdate.getMonth();
            var jyear = jdate.getFullYear();

            var jdate = [jyear, jmonth, jday].join('-');

            $.ajax({

              url: './functions/updateEmployee.php',
              type: 'POST',
              data: {
                empID: $("input[name='empid']").val(),
                fName: $("input[name = 'firstName']").val(),
                lName: $("input[name='lastName']").val(),
                mName: $("input[name='middleName']").val(),
                gender: $("input[name='gender']:checked").val(),
                email: $("input[name='email']").val(),
                contactNo: $("input[name='contactNo']").val(),
                company: $("select[name='company-code']").val(),
                dob: dob,
                address: $("input[name='address']").val(),
                deptCode: $("select[name='dept-code']").val(),
                position: $("input[name='position']").val(),
                jdate: jdate,
                action: "update"
              },
              success: function(response) {
                if(response == 1) {
                  swal({
                    title: "Success",
                    text: "Employee Successfully Updated.",
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
        }

      </script>
      <script src="./js/sweetalert.js"></script>
  </body>
</html>