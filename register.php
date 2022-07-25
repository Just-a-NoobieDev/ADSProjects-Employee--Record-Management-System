<?php
include "./includes/db.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is our final project in our subject Advance Database System">
    <meta name="keywords" content="ERMS, Employee Management, Employee Record, System, Database">

    <title>Register | ERMS System</title>

 <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/index.css">

    <!-- JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
      body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }
      .left {
        position: fixed;
        background-color: #4e52b6;
        height: 100vh;
        width: 47%;
        position: fixed;
        top: 0;
        left: 0;
      }
      .center {
        z-index: 10000;;
        height: 500px;
        width: 900px;
        background: transparent;
        box-shadow: 1px 18px 31px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        display: flex;
      }
      .center-left {
        width: 40%;
        height: 100%;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        font-weight: bold;
      }
      p {
        font-weight: 500;
        margin-top: 1rem;
      }
      p > a {
        text-decoration: underline;
        font-weight: bold;
        color: #fff;
      }
      p > a:hover {
        background-color: #fff;
        color: #4e52b6;
        padding: 5px;
        text-decoration: none ;
      }
      .center-form {
        width: 60%;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      .link {
          text-decoration: underline;
          color: #fff;
          font-weight: 500;
          padding: 10px;

      }

      .link:hover {
          background-color: #fff;
          color: #4e52b6;
          text-decoration: none;
      }

    </style>
  </head>
  <body>

    <div class="left"></div>
    <div class="center">
      <div class="center-left">
        <h1>REGISTER AN ACCOUNT | ERMS SYSTEM</h1>
        <a href="login.php" class="link">Login here</a>
      </div>
      <form action="" class="center-form" method="POST">
          <div class="form-group w-75">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
         <div class="form-group w-75">
            <label for="email" >Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="form-group w-75">
            <label for="password" >Password</label>
            <input type="password" name="pass" class="form-control" required>
          </div>
          <div class="form-group w-75">
            <label for="c-password" >Confirm Password</label>
            <input type="password" name="c-pass" class="form-control" required>
          </div>
          <button class="mb-4 btn-submit" type="submit" name="submit" id="btn" >Register</button>
      </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn").on('click', function(e) {
                e.preventDefault();


                $.ajax({
                    url: "./functions/registerAdmin.php",
                    type: "POST",
                    data: {
                        username: $("input[name = 'username']").val(),
                        email: $("input[name = 'email']").val(),
                        pass: $("input[name = 'pass']").val(),
                        cpass: $("input[name = 'c-pass']").val(),
                        action: "register"
                    },
                    success: function(response) {
                        console.log(response)
                        if(response == 1) {
                            $("input[name = 'username']").val("")
                            $("input[name = 'email']").val("")
                            $("input[name = 'pass']").val("")
                            $("input[name = 'cpass']").val("")
                            swal({
                                title: "Success",
                                text: "New Employee Added.",
                                icon: "success",
                                button: "close"
                            })
                        } else if(response == 2) {
                            swal({
                                title: "Error",
                                text: "Password  Not Matched.",
                                icon: "error",
                                button: "close"
                            })
                        } else if(response == 3) {
                            swal({
                                title: "Error",
                                text: "Email already exist.",
                                icon: "error",
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