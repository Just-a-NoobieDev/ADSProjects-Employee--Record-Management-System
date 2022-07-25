<?php
session_start();
include './includes/db.php';


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is our final project in our subject Advance Database System">
    <meta name="keywords" content="ERMS, Employee Management, Employee Record, System, Database">

    <title>ERMS | View Details</title>

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

    <main class="view-form">

      <?php 
          include_once "./includes/navbar.php";
      ?>

      <div class="add-form">
        <div class="view">
          <h2 class="section-title mb-4">VIEW EMPLOYEE DETAILS</h2>
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
                <button class="mb-4 btn-submit w-100" type="submit" name="button" id="viewbtn">FETCH DETAILS</button>
              </div>
            </form>
          </div>
        </div>
        
        <div class="container details shadow rounded p-4" id="main-form">
            <div class="head">
              <h2 class="emp-name" id="name">Juan Dela Cruz</h2>
              <h5 class="emp-id">Employee ID: <span id="empid">00001</span></h5>
            </div>
            <div class="p-details">
              <div class="d-flex mt-5 align-items-center justify-content-around">
                <h3>Company Code: <span id="cc">CP1</span></h3>
                <h3>Company Name: <span id="cn">Company A</span></h3>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-around">
                <h3>Department Code: <span id="dc">IT</span></h3>
                <h3>Department Name: <span id="dn">IT Personel</span></h3>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-around">
                <h3>Gender: <span id="gender">Male</span></h3>
                <h3>Position: <span id="pos">Programmer</span></h3>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-around">
                <h3>Email: <span id="email">test@test.com</span></h3>
                <h3>Employment Date: <span id="ed">2020-12-20</span></h3>
              </div>
              <div class="d-flex mt-4 align-items-center justify-content-around">
                <h3>Address: <span id="address">Hagonoy, Bulacan</span></h3>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-around">
                <h3>Contact No.: <span id="contact">090000000</span></h3>
              </div>
              <div class="d-flex mt-2 align-items-center justify-content-around">
                <h3>BirthDate: <span id="bday">2002-04-14</span></h3>
              </div>
            </div>
            <button class="mb-4 mt-5 btn-submit w-25" id="back">Back</button>
        </div>
      </div>
    </main>

      <script type="text/javascript">

          $(document).ready(function() {
            $("#viewbtn").on('click', function(e) {
              e.preventDefault();
              
              var id = $("input[name='empid']").val();
              var company = $("select[name='company-code']").val()
              
              if(id !== "" && company !== "") {
                  $.ajax({
                    type: "POST",
                    url: './functions/viewDetails.php',
                    dataType: 'json',
                    data: {
                      id: id,
                      company: company,
                      action: 'retrieve'
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
                        
                        $(".view").addClass('none')
                        $('#main-form').addClass('block')

                        var data = response;

                        $('#name').html(data[3] + " " + data[4])
                        $('#empid').html(data[2])
                        $('#cc').html(data[12])
                        $('#cn').html(data[17])
                        $('#dc').html(data[13])
                        $('#dn').html(data[1])
                        $('#gender').html(data[6])
                        $('#pos').html(data[14])
                        $('#ed').html(data[15])
                        $('#email').html(data[7])
                        $('#address').html(data[10])
                        $('#contact').html(data[8])
                        $('#bday').html(data[9])

                      }
                    },
                    error: function(xhr, status, error) {
                          // check status && error
                          console.log(xhr, status, error)
                      },
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

              $('#back').on('click', function() {
                location.reload();
              })
          })

      </script>
    <script src="./js/sweetalert.js"></script>
  </body>
</html>