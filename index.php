<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="icon/jobshop_logo.png" />
  <title>Job Shop - Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header" style="margin-bottom: 15px;">Login</div>
      <img src="icon/jobshop_logo.png" alt="" style="height: 153px; padding: 5%; width: 72%;margin: auto; border: 1px solid #7bc1bf;">
      <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <input type="submit" name="login-btn" class="btn btn-primary btn-block" value="Login" style="background-color: #75c0c6; border-color: #03eafd;">
        </form>
        <!-- <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>


<!-- login php source code start-->
  <?php
    require 'include/config.php';
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
        session_start();
      // username and password sent from form
        $email = $_POST['email'];



        $password = $_POST['password'];
        $password =md5($password);

         $sql ="SELECT * FROM signup WHERE email ='$email' and password ='$password'";
         $result=mysqli_query($conn,$sql);
         $count =mysqli_num_rows($result); // if uname/pass correct it returns must be 1 row

         if($count == 1 )
          {
             session_regenerate_id();
             $_SESSION['email'] = $email;
             session_write_close();
             header('Location: content/home.php');

         }
         else
         {
            echo "<script type='text/javascript'>alert('Incorrect Credentials, Try again...');window.location = \"index\"</script>";
         }
   }

  ?>
  <!-- login php source code end-->
