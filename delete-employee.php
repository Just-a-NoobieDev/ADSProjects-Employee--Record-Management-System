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

    <title>ERMS | Delete Employee</title>

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

      <main class="delete-form">

        <?php 
            include_once('./includes/navbar.php');
        ?>

        <h2 class="section-title mb-4">DELETE EMPLOYEE</h2>
        <div class="container w-75 delete shadow rounded d-flex align-items-center delete-div">
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
              <button class="mb-4 btn-submit w-100" type="submit" name="button" id="deletebtn">Delete</button>

            </div>
            
          </form>
        </div>
      </main>


    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Wait a second!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="deleteform" action="" method="POST">
            <input type="hidden" name="emp-id" id="employee_id" >
            <div class="modal-body">
              Are you sure you want to delete all the details of the employee with the ID of <span id="empid">00000</span> ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button  type="submit" name="confirm-delete" class="btn btn-danger" onclick="deleteID();">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    

    <script type="text/javascript">
      

      $(document).ready(function()  {
        $('#deletebtn').click(function(e) {
          e.preventDefault();
          var id = $("input[name='empid']").val();

            if(id !== "") {
              $('#empid').html(id);
              $('#employee_id').val(id);
              $('#deleteModal').modal('show');
            } else {
              swal({
                title: "Error",
                text: "Please enter employee id or select company code",
                icon: "error",
                button: "close"
              })
            }
        })
      });

      let form = document.getElementById("deleteform");
        function handleForm(event) {
          event.preventDefault();
        }

      form.addEventListener('submit', handleForm)


      function deleteID() {
        
        $('#deleteModal').modal('hide');

          $.ajax({
              url: './functions/delete.php',
              type: 'POST',
              data: {
                empID: $("input[name='emp-id']").val(),
                company: $("select[name = 'company-code']").val()
              },
              success: function(response) {
                  if(response == 1) {
                    swal({
                      title: "Success",
                      text: "Employee has been deleted",
                      icon: "success",
                      button: "close"
                    })
                  } else if(response == 2) {
                    swal({
                      title: "Error",
                      text: "Employee ID that you entered is not existing",
                      icon: "error",
                      button: "close"
                    })
                  } else if(response == 3) {
                    swal({
                      title: "Error",
                      text: "Something went wrong. Contact the owner of this website.",
                      icon: "error",
                      button: "close"
                    })
                  } else {
                    
                  }
                    //console.log(response);
               }
            })

      }




            



    </script>

    <script src="./js/sweetalert.js"></script>
  </body>
</html>