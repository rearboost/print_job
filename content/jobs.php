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
  <title>Job Shop - Job List</title>
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Job List</li>
      </ol>
      <div class="row">
      <div class="col-md-10">
      <input type="text" name="search_text" id="search_text" placeholder="Search by Job Number " class="form-control  form-control-sm" style="width: 40%;"/>
      </div>
      <!-- <div class="col-md-2">
        <button type="button" id="" name="" class="btn btn-primary btn-sm submit_data" data-toggle="modal" data-target="#myModal1" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px; float:right" ><font color="green"><b>+ </b></font>New Job</button>
      </div> -->
      </div>
  <div id="result"></div>
      

      
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

<script>
$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"../tables/jobs_table.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
 });
</script>