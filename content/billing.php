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
  <title>Job Shop - Inbound Requests</title>
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
        <li class="breadcrumb-item active">Billing</li>
      </ol>
      <div class="row">
      <div class="col-md-8">
      <input type="text" name="search_text" id="search_text" placeholder="Search by Job No" class="form-control  form-control-sm" style="width: 60%; height: 40px;"/>
      </div>
      <div class="col-md-4">
        <input type="date" name="bill_date" id="bill_date" class="form-control">
      </div>
      </div>

      <br>
       <!-- Inbound Requests table view -->
      <div id="result">

      </div>
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


<!-- Inbound Requests table view in ajax -->
<script>
$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"../tables/billing_table.php",
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

////////////// select bill data according to the date ///////////////////////
  $("#bill_date").on('change',function(){
    var date = $(this).val();
      
      $.ajax({
         url:"../tables/billing_table.php",
         method:"POST",
         data:{date:date},
         success:function(data)
         {
          $('#result').html(data);
         }
      });
         
    
  });


});


</script>
<!-- end -->
