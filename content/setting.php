<?php
  // session check
  include('../include/check.php');
  // Database Connection
  require '../include/config.php';

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- head title and icon -->
  <link rel="shortcut icon" href="../icon/jobshop_logo.png" />
  <title>Job Shop -  Settings</title>
  <!-- header -->
  <?php include('../include/head.php'); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include('../include/nav.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Settings</li>
      </ol>

      <div class="col-md-12">
      <div class="row">
      <div class="col-md-6">
        <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">CHANGE PASSWORD</b></span>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
          <form>
            <div class="col-sm-12 form-group">
              <label for="oldpassword">Old Password</label>
              <div class="col-sm-12">
                 <input type="password" name="" value="" class="form-control" id="oldpassword">
                 <label id="oldpassword_error" class="error" for="oldpassword" style="display: none;  color: red;">This field is required.</label>
              </div>
            </div>
            <div class="col-sm-12 form-group">
              <label for="newpassword">New Password</label>
              <div class="col-sm-12">
                 <input type="password" name="" value="" class="form-control" id="newpassword">
                 <label id="newpassword_error" class="error" for="newpassword" style="display: none;  color: red;">This field is required.</label>
              </div>
            </div>
            <div class="col-sm-12 form-group">
              <div class="col-sm-12">
                <button type="button" name="button" class="btn btn-primary btn-sm" id="cp_btn" name="cp_btn" onclick="cpForm()" style="height: 35px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 5px; margin-left: 1.5%;">Change Password</button>
              </div>
            </div>
          </form>
          <div id="snackbar"><p id="msg_view"></p></div>
          </div>
        </div>
      </div>
        
      </div>

      <div class="col-md-6">
        <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">ADD NEW USER</b></span>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form>
                <div class="col-sm-12">
                  <label>Username</label>
                  <input type="text" name="username" id="username" placeholder="Place username here" class="form-control" style="margin-bottom: 10px;" />
                  <label id="username_error" class="error" style="display: none;  color: red;">This field is required.</label>
                </div>
                
                <div class="col-sm-12">
                  <label>Password</label>
                  <input type="password" name="password" id="password" placeholder="Place password here"class="form-control" style="margin-bottom: 10px;"  />
                  <label id="password_error" class="error" style="display: none;  color: red;">This field is required.</label>
                </div>

                <div class="col-sm-12">
                  <label>Confirm Password</label>
                  <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" class="form-control" style="margin-bottom: 10px;"  />
                  <label id="cpassword_error" class="error" style="display: none;  color: red;">This field is required.</label>
                  <label id="confirm_error" class="error" style="display: none;  color: red;">Password does not match.</label>
                </div>

                <div class="col-sm-12">
                  <label>User Level</label>
                  <SELECT name="level" id="level" class="form-control" style="margin-bottom: 10px;" >
                     

                    <option value="">Select</option>
                    <?php
                    $level = "SELECT *
                              FROM user_level";

                    $result = mysqli_query($conn,$level);
                    $numRows = mysqli_num_rows($result); 
     
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($result)) {

                        echo '<option value = "'.$row["id"].'"> '. $row['description'] .' </option>';
                          
                        }
                      }
                    ?>
                  </SELECT>
                  <label id="level_error" class="error" style="display: none;  color: red;">This field is required.</label>
                </div>
                <div class="col-sm-12">
                  <button type="button" id="form_btn_signin" name="form_btn_signin" onclick="new_user()" class="btn btn-primary col-sm-12" style="height: 35px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 5px; margin-left: 1.5%;">SIGN UP</button>
                </div>
            </form>
            <div id="snackbar"><p id="msg_view"></p></div>
          </div>
        </div>
      </div>

      </div> <!-- col-md-6-->
      </div> <!-- row-->
      </div> <!-- col-md-12-->

    </div><!-- container fluid -->



    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2021</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <?php include('../include/modal.php'); ?>
    <!-- Bootstrap core JavaScript-->
    <?php include('../include/footer_js.php'); ?>
  </div>
</body>

</html>
<script type="text/javascript">

  // oldpassword and newpassword required
  $(document).ready(function(){
      // form1
     $('#oldpassword').keydown(function(){

       var val1 =$(this).val();

       if(val1==''){

       }
       else{
         $('#oldpassword_error').css("display", "none");
         $('#oldpassword').css("border", "1px solid #ced4da");
       }

     });
     $('#newpassword').keydown(function(){

       var val2 =$(this).val();

       if(val2==''){

       }
       else{
         $('#newpassword_error').css("display", "none");
         $('#newpassword').css("border", "1px solid #ced4da");
       }

     });

    // form2
    $('#username').keyup(function(){

       var val1 =$(this).val();

       if(val1==''){

       }
       else{
         $('#username_error').css("display", "none");
         $('#username').css("border", "1px solid #ced4da");
       }

     });
    
     $('#password').keyup(function(){

       var val2 =$(this).val();

       if(val2==''){

       }
       else{
         $('#password_error').css("display", "none");
         $('#password').css("border", "1px solid #ced4da");
       }

     });

     $('#cpassword').keydown(function(){

       var val2 =$(this).val();

       if(val2==''){

       }
       else{
         $('#cpassword_error').css("display", "none");
         $('#confirm_error').css("display", "none");
         $('#cpassword').css("border", "1px solid #ced4da");
       }

     });

     $('#level').click(function(){

       var val2 =$(this).val();

       if(val2==''){

       }
       else{
         $('#level_error').css("display", "none");
         $('#level').css("border", "1px solid #ced4da");
       }

     });
  });

  // Change password ajax code
  function cpForm() {

    var oldpassword =document.getElementById('oldpassword').value;
    var oldpasswordcheck =document.getElementById('oldpassword').value;

    var newpassword =document.getElementById('newpassword').value;
    var newpasswordcheck =document.getElementById('newpassword').value;


    var cp_btn =document.getElementById('cp_btn').name;

    if(oldpasswordcheck=='' && newpasswordcheck==''){

     $('#newpassword_error').css("display", "inherit");
     $('#newpassword').css("border", "1px solid red");
     $('#oldpassword_error').css("display", "inherit");
     $('#oldpassword').css("border", "1px solid red");
    }
    else if (newpasswordcheck=='') {

      $('#newpassword_error').css("display", "inherit");
      $('#newpassword').css("border", "1px solid red");
    }
    else if (oldpasswordcheck=='') {
      $('#oldpassword_error').css("display", "inherit");
      $('#oldpassword').addClass('error');
      $('#oldpassword').css("border", "1px solid red");
    }
    else {
      $.ajax({
        url:"../controller/setting_controller.php",
        method:"POST",
        data:{oldpassword:oldpassword,newpassword:newpassword,cp_btn:cp_btn},
        success:function(data){

        // Message success call function
           myformcp();
           $('#msg_view').html(data);
        }
     });
    }

  }

  // Message  view
  function myformcp() {
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

      // Location refech
      setTimeout(function(){location.reload(); },2500);
  }

function new_user() {

    var username =document.getElementById('username').value;
    var username_checked =document.getElementById('username').value;

    var password =document.getElementById('password').value;
    var password_checked =document.getElementById('password').value;

    var cpassword =document.getElementById('cpassword').value;
    var cpassword_checked =document.getElementById('cpassword').value;

    var level =document.getElementById('level').value;
    var level_checked =document.getElementById('level').value;


    var form_btn_signin =document.getElementById('form_btn_signin').name;

  if(username_checked==''){
    $('#username_error').css("display", "inherit");
    $('#username').css("border", "1px solid red");

  }else if(password_checked==''){
    $('#password_error').css("display", "inherit");
    $('#password').css("border", "1px solid red");

  }else if(cpassword_checked==''){
    $('#cpassword_error').css("display", "inherit");
    $('#cpassword').css("border", "1px solid red");
    
  }else if(level_checked==''){
    $('#level_error').css("display", "inherit");
    $('#level').css("border", "1px solid red");
    
  }else if(password_checked != cpassword_checked){
    $('#confirm_error').css("display", "inherit");
    $('#cpassword').css("border", "1px solid red");
  }else {

      $.ajax({
        url:"../controller/setting_controller.php",
        method:"POST",
        data:{username:username,password:password,level:level,form_btn_signin:form_btn_signin},
        success:function(data){

        // Message success call function
           new_usercp();
           $('#msg_view').html(data);
        }
     });

  }
  }

  // Message  view
  function new_usercp() {
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

      // Location refech
      setTimeout(function(){location.reload(); },2500);
  }
//////////////////// 
</script>
