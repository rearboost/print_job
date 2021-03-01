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
  <title>Job Shop - Daily Sales Report</title>
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
        <li class="breadcrumb-item active">Reports</li>
        <li class="breadcrumb-item active">Daily Sales</li>
      </ol>

      <div class="row">
        <div class="col-md-4">
          <label>Pick a date</label>
          <input type="date" name="search_date" id="search_date" class="form-control form-control-sm" />
        </div>
        <div class="col-md-4">
          <label>Pick a month</label>
          <select class="form-control  form-control-sm" name="month" id="month">
            <option value="January">January</option> <option value="February">February</option>
            <option value="March">March</option> <option value="April">April</option>
            <option value="May">May</option> <option value="June">June</option>
            <option value="July">July</option> <option value="August">August</option>
            <option value="September">September</option> <option value="October">October</option>
            <option value="November">November</option> <option value="December">December</option>
          </select>
        </div>
        <div class="col-md-4">
          <label>Pick a year</label>
          <select class="form-control  form-control-sm" name="year" id="year">
            <?php
                          
              //fetch years 
              $get_year = "SELECT DISTINCT(dispatch_year)AS year FROM jobs WHERE dispatch_year<>''";

              $result = mysqli_query($conn,$get_year);
              $numRows = mysqli_num_rows($result); 

                if($numRows > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value = ".$row['year'].">" . $row['year'] . "</option>";
                    
                  }
                }
              ?>
          </select>
        </div>
      </div>
  
      
      <br>
       <!-- Dispatch  table view -->
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


<!-- Dispatch  table view in ajax -->
<script>
$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"../tables/dailysales_table.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_date').change(function(){
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
<!-- end -->


