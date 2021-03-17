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
  <link rel="shortcut icon" href="../icon/small.jpg" />
  <title>Job Ordering System - Daily Sales Report</title>
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
        <li class="breadcrumb-item active">Reports</li>
        <li class="breadcrumb-item active">Daily Sales</li>
      </ol>

      <div class="row" style="margin-left: 2px; margin-right: 10px;">
        <div class="col-md-4">
          <label>Pick a year</label>
          <select class="form-control" name="year" id="year">
            <option selected="" disabled="">Select Year</option>
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
        <div class="col-md-4">
          <label>Pick a month</label>
          <select class="form-control" name="month" id="month">
            <option selected="" disabled="">Select Year First</option>
          </select>
        </div>
        <div class="col-md-4">
          <label>Pick a date</label>
          <input type="date" name="search_date" id="search_date" class="form-control"/>
        </div>
      </div>
  
      <br><hr><br>
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

 $('#month').on('change', function() {
     var year = $('#year').val();
     var month = $(this).val();

    $('#search_date').val('');

    if(year){
      $.ajax({
         url:"../tables/dailysales_table.php",
         method:"POST",
         data:{month:month,year:year},
         success:function(data)
         {
          $('#result').html(data);
         }
      });
    }else{
      alert('Please select the year first');
      $('#month').val('');
    }
      
  });

 $('#year').on('change', function() {
     var year = $(this).val();
     var month = $('#month').val();

     $('#search_date').val('');

      $.ajax({
         url:"../tables/dailysales_table.php",
         method:"POST",
         data:{month:month,year:year},
         success:function(data)
         {
          $('#result').html(data);
         }
      });

      

      if(year){
        
        $.get(
          "../functions/get_month.php",
          {year:year},
          function (data) { 
            $('#month').html(data);
          }
        );
           
      }else{
        $('#month').html('<option>Select Job Type First</option>');
      }

  });

});
</script>
<!-- end -->


