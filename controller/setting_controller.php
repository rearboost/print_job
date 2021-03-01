<?php
  // database Connection
  require '../include/config.php';
  session_start();

    //setting php code strat change password
   if(isset($_POST['cp_btn']))
   {
     $oldpassword =mysqli_real_escape_string($conn ,$_POST['oldpassword']);
     $oldpassword =md5($oldpassword);
     $newpassword =mysqli_real_escape_string($conn ,$_POST['newpassword']);
     $newpassword =md5($newpassword);


     $query ="SELECT * FROM signup WHERE email='".$_SESSION['email']."'";
     $result =mysqli_query($conn,$query);

     while ($row=mysqli_fetch_array($result))
    {
         $password=$row['password'];
    }

    if($password==$oldpassword){

      $query ="UPDATE  signup  SET password=? WHERE email=?;";

      $stmt =mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$query))
      {
         echo "SQL Error";
      }
      else
      {
          mysqli_stmt_bind_param($stmt,"ss",$newpassword,$_SESSION['email']);
          $result =  mysqli_stmt_execute($stmt);
          if($result){
              echo "Successful Change Password";
          }
      }
    }
    else {
       echo "Old password Not Match!";
    }

   }

  if(isset($_POST['form_btn_signin'])){
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $password  = mysqli_real_escape_string($conn, $_POST['password']);
    $password  = md5($password);
    $level     = mysqli_real_escape_string($conn, $_POST['level']);

    $check_query = mysqli_query($conn, "SELECT * FROM signup WHERE email = '$username'");
    $emailcount = mysqli_num_rows($check_query);

    if($emailcount>0){
      echo "Username is already exists.";
    }else{
        $new_signup = mysqli_query($conn, "INSERT INTO signup(email,password,level) VALUES ('$username','$password', '$level')");
        if($new_signup){
            echo "Successfully created new user account!";
        }else{
            echo "Failed!";
        }
    }

  }


 ?>
