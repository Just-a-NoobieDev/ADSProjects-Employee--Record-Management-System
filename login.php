<?php
include "./includes/db.php";
session_start();
error_reporting(0);
if(isset($_POST['submit'])) {
  
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if(empty($email) || empty($pass)) {
      echo"";
    } else {
      $query = "SELECT * FROM tbladminaccount WHERE email = '$email' AND pass = '$pass';";
      $result = mysqli_query($con, $query);

      if(mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $_SESSION['username'] = $row['username'];
          $_SESSION['user_id'] = $row['id'];
          $email = "";
          $_POST['pass'] = "";
          $path = $_SERVER['localhost']. '/employee-management-system';
          header("Location: $path/index.php");
      } else {
        echo '<script>alert("Email or Password is wrong")</script>';
        header("Refresh:0");
        $email = "";
        $_POST['pass'] = "";
      }
    }
  
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is our final project in our subject Advance Database System">
    <meta name="keywords" content="ERMS, Employee Management, Employee Record, System, Database">
    
    <title>Login | ERMS System</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    
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

    </style>
  </head>
  <body>

    <div class="left"></div>
    <div class="center">
      <div class="center-left">
        <h1>LOGIN TO ERMS SYSTEM</h1>
        <p>Don't have an account? <a href="register.php">Register Here</a></p>

      </div>

      <form action="" class="center-form" method="POST">
         <div class="form-group w-75">
            <label for="email" >Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
          </div>
          <div class="form-group w-75">
            <label for="password" >Password</label>
            <input type="password" name="pass" class="form-control" value="<?php echo $_POST['pass'] ?>" required>
          </div>
          <button class="mb-4 btn-submit" type="submit" name="submit" id="btn" >Login</button>
      </form>
    </div>

  </body>
</html>