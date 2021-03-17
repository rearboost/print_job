<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    .tablealign
    {
      margin-right: 10px;
    }
  </style>
  <title></title>
  <!-- Colour picker -->
  <script src="../js/jscolor.js"></script>

</head>
<body>
  <?php

   // session check
   include('../include/check.php');
   // Database Connection
   require '../include/config.php';

   $view_status ="complete";

  if(isset($_POST["query"]))
  {
     $search =$_POST["query"];
     $query = "SELECT * FROM jobs WHERE state='$view_status' AND customer LIKE '%".$search."%' ";
  } 
  else if(isset($_POST["date"]))
  {
     $bill_date =$_POST["date"];
     $query = "SELECT * FROM jobs WHERE state='$view_status' AND dispatch_day = '$bill_date' ";
  }
  else if(isset($_POST["query"]) && ($_POST["date"]))
  {
     $search =$_POST["query"];
     $bill_date =$_POST["date"];
     $query = "SELECT * FROM jobs WHERE state='$view_status' AND dispatch_day = '$bill_date' AND job_no LIKE '%".$search."%' ";
  }
  else
  {
     $query = "SELECT * FROM jobs WHERE state='$view_status'";
  }
  $result = mysqli_query($conn ,$query);

  if(mysqli_num_rows($result)>0)
  {
    ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <div class="tablealign">
<!--  <script src="jquery.tabledit.min.js"></script> -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php include('../include/head.php'); ?>
  <table id="example" class="table table-striped table-bordered" style="width:100%">
   <thead>
    <tr>
     <th>Date</th>
     <th>Job No</th>
     <th>Customer</th>
     <th>Description</th>
     <th>Budget</th>
     <th></th>
    </tr>
   </thead>
   <tbody>
   <?php
   $i=1;
   while($row = mysqli_fetch_array($result))
   {
    echo '
    <tr>
     <td>'.$row["dispatch_day"].'</td>
     <td>'.$row["job_no"].'</td>
     <td>'.$row["customer"].'</td>
     <td>'.$row["product"].'</td>
     <td>'.$row["budget"].'</td>

      <td><button type="button"  id="' .$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModal" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px;">View</button></td>
    </tr>';
    $i++;
   }
   ?>
   </tbody>
  </table>
</div>
   <?php
  }
  else
  {
   echo 'Data Not Found';
  }

  ?>
  </body>
  </html>
  <script>


  // Modal load value in jquery
  $(document).on('click', '.view_data', function(){

    var view_id = $(this).attr("name");

    $.ajax({
         url:"../controller/billing_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
            //$('#comment_val').html(data);
           var data =JSON.parse(data);

           $('#job_no').html(data['job_no']);
           $('#customer').html(data['customer']);
           $('#product').html(data['product']);
           $('#budget').html(data['budget']);
           $('#discount').html(data['discount']);
           $('#discounted').html(data['discounted']);
           $('#ad_pay_amount').html(data['ad_pay_amount']);
           $('#payment').html(data['payment']);
           $('#cash').html(data['cash']);
           $('#change_amt').html(data['change_amt']);
           $('#dispatch_day').html(data['dispatch_day']);

           $('#job_id').val(data['id']);
           $('#job_no').val(data['job_no']);
           $('#customer').val(data['customer']);
           $('#product').val(data['product']);
           $('#budget').val(data['budget']);
           $('#discount').val(data['discount']);
           $('#discounted').val(data['discounted']);
           $('#ad_pay_amount').val(data['ad_pay_amount']);
           $('#payment').val(data['payment']);
           $('#cash').val(data['cash']);
           $('#change_amt').val(data['change_amt']);
           $('#dispatch_day').val(data['dispatch_day']);
         }
    });
  });

  </script>

<!-- Edid From  Past medical history Modal -->
 <div id="myModal" class="modal fade">
    <div class="modal-dialog" style="max-width: 350px;">
     <div class="modal-content" style="height : auto;">
        <div class="modal-header" style="background-color: #ffffff;">
          <!-- <span style="font-size: 23px;"><b style="color: white;letter-spacing: 1.3px;">Invoice</b></span> -->
          <img src="../icon/small.jpg" style="padding-left:30%; padding-right:30%;"> 

          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #d6e1e9;">
         <form method="post" id="pmh_form_edit">
          <div class="col-sm-12">
           <div class="row">
             <div class="col-sm-4" style="margin-left: 15px;">
               <label>Date </label>
             </div>
             <div class="col-sm-6">
              <span style="display: inline-block; margin-left: 1%;"><div id="dispatch_day"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-4" style="margin-left: 15px;">
               <label>Job # </label>
             </div>
             <div class="col-sm-6">
               <span style="display: inline-block; margin-left: 1%;"><div id="job_no"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-4" style="margin-left: 15px;">
               <label>Customer </label>
             </div>
             <div class="col-sm-6">
               <span style="display: inline-block; margin-left: 1%;"><div id="customer"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-4" style="margin-left: 15px;">
               <label>Description </label>
             </div>
             <div class="col-sm-6">
               <span style="display: inline-block; margin-left: 1%;"><div id="product"></div></span>
             </div>
           </div>
           <hr>
           <div class="row">
             <div class="col-sm-6" style="margin-left: 15px;">
               <label>TOTAL AMOUNT </label>
             </div>
             <div class="col-sm-4" style="text-align: right;">
              <span style="display: inline-block; margin-left: 1%;"><div id="budget"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-6" style="margin-left: 15px;">
               <label>DISCOUNT(%) </label>
             </div>
             <div class="col-sm-4" style="text-align: right;">
               <span style="display: inline-block; margin-left: 1%;"><div id="discount"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-6" style="margin-left: 15px;">
               <label>NET AMOUNT  </label>
             </div>
             <div class="col-sm-4" style="text-align: right;">
               <span style="display: inline-block; margin-left: 1%;"><div id="ad_pay_amount"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-6" style="margin-left: 15px;">
               <label>ADVANCE </label>
             </div>
             <div class="col-sm-4" style="text-align: right;">
               <span style="display: inline-block; margin-left: 1%;"><div id="discounted"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-6" style="margin-left: 15px;">
               <label>REST  </label>
             </div>
             <div class="col-sm-4" style="text-align: right;">
              <span style="display: inline-block; margin-left: 1%;"><div id="payment"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-6" style="margin-left: 15px;">
               <label>CASH  </label>
             </div>
             <div class="col-sm-4" style="text-align: right;">
               <span style="display: inline-block; margin-left: 1%;"><div id="cash"></div></span>
             </div>
           </div>
           <div class="row">
             <div class="col-sm-6" style="margin-left: 15px;">
               <label>CHANGE  </label>
             </div>
             <div class="col-sm-4" style="text-align: right;">
               <span style="display: inline-block; margin-left: 1%;"><div id="change_amt"></div></span>
             </div>
           </div>
          </div>
         </form>
        </div>
     </div>
    </div>
 </div>

   <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>

