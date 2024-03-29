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

      if(isset($_POST["query"]))
      {
         $search =$_POST["query"];
         $query = "SELECT * FROM jobs WHERE job_no LIKE '%".$search."%' ";
      }
      else
      {
      $query = "SELECT * FROM jobs ORDER BY id DESC";
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
  <!-- <table id="editable_table" class="table table table-striped"> -->
  <table id="example" class="table table-striped table-bordered" style="width:100%">
   <thead>
    <tr>
     <th>#</th>
     <th>CUSTOMER</th>
     <th>ITEM</th>
     <th>ACCEPTED DATE</th>
     <th>STATUS</th>
     <th></th>
     <?php
     $user = $_SESSION['email'];
     $qry = mysqli_query($conn ,"SELECT level FROM signup WHERE email='$user'");

     $data = mysqli_fetch_array($qry);
     $level= $data['level'];
     if($level==1 || $level==2){
      echo '<th></th>';
     }else{
      echo '<th hidden=""></th>';
     }

     ?>
    </tr>
   </thead>
   <tbody>
   <?php
   $i=1;
   while($row = mysqli_fetch_array($result))
   {
    echo '
    <tr>
     <td>'.$row["job_no"].'</td>
     <td>'.$row["customer"].'</td>
     <td>'.$row["product"].'</td>
     <td>'.$row["date"].'</td>';
     if($row["state"]=="request"){
        echo 
        '<td> <center> <label class="btn-sm" style="background-color:green; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."NEW".'</label></center></td>';

     // }else if($row["state"]=="design" || $row["state"]=="production" || $row["state"]=="QA"){
     }else if($row["state"]=="design"){
        echo 
        '<td> <center> <label class="btn-sm" style="background-color:#e6005c; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."DESIGN".'</label></center></td>';

     }else if($row["state"]=="production"){
        echo 
        '<td> <center> <label class="btn-sm" style="background-color:orange; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."PRODUCTION".'</label></center></td>';
        
     }else if($row["state"]=="QA"){
        echo 
        '<td> <center> <label class="btn-sm" style="background-color:#00a3cc; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."QA".'</label></center></td>';

     }else if($row["state"]=="dispatch"){
        echo 
        '<td> <center> <label class="btn-sm" style="background-color:blue; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."DISPATCH".'</label></center></td>';

     }else if($row["state"]=="complete"){
        echo 
        '<td> <center> <label class="btn-sm" style="background-color:gray; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."COMPLETE".'</label></center></td>';

     }else if($row["state"]=="reject"){
        echo 
        '<td> <center> <label class="btn-sm" style="background-color:red; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."REJECT".'</label></center></td>';
     }
    echo '
      <td><button type="button"  id="' .$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModaljobs" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px;">View</button></td>';
     
    if($level==1 || $level==2){
      echo '<td style="width: 5%;"><a href="../controller/jobs_controller?j_delete_id='.$row["id"].'" onclick="confirmation(event)">Delete</a></td>';
    }else{
      echo '<td style="width: 5%;" hidden><a href="../controller/jobs_controller?j_delete_id='.$row["id"].'" onclick="confirmation(event)">Delete</a></td>';
    }
    '</tr>
     ';
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
  function confirmation(e) {
       var answer = confirm("Are you sure you want to permanently delete this record?")
    if (!answer){
      e.preventDefault();
      return false;
    }
  }

  // Modal load value in jquery
  $(document).on('click', '.view_data', function(){

    var view_id = $(this).attr("name");

    $.ajax({
         url:"../controller/jobs_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
            //$('#comment_val').html(data);
           var data =JSON.parse(data);

           $('#id_edit').html(data['id']);
           $('#no_edit').html(data['job_no']);

           $('#job_edit').val(data['id']);
           $('#job_no_edit').val(data['job_no']);
           $('#customer_edit').val(data['customer']);
           $('#accepted_by_edit').val(data['accepted_by']);
           $('#checked_by_edit').val(data['checked_by']);
           $('#channel_edit').val(data['channel']);
           $('#type_edit').val(data['job_type']);
           $('#product_edit').val(data['product']);
           $('#category_edit').val(data['category']);
           $('#quantity_edit').val(data['quantity']);
           $('#unit_price_edit').val(data['unit_price']);
           $('#material_edit').val(data['material']);
           $('#size_edit').val(data['size']);
           $('#bind_edit').val(data['bind']);
           $('#colour_edit').val(data['colour']);
           $('#budget_edit').val(data['budget']);
           $('#discount_edit').val(data['discount']);
           $('#discounted_edit').val(data['discounted']);
           $('#ad_pay_amount_edit').val(data['ad_pay_amount']);
           $('#rest_edit').val(data['rest']);
           $('#date_edit').val(data['date']);
           $('#cash_edit').val(data['cash']);
           $('#change_edit').val(data['change_amt']);
           $('#payment_edit').val(data['payment']);
           $('#dispatch_day_edit').val(data['dispatch_day']);
           $('#user_description_edit').val(data['user_description']);
           $('#admin_description_edit').val(data['admin_description']);
         }
    });

  });
  </script>

<!-- Complete From Modal -->
<div id="myModaljobs" class="modal fade">
  <div class="modal-dialog" style="max-width: 1000px;">
    <div class="modal-content" style="height : auto;">
      <div class="modal-header" style="background-color: #507183;">
        <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">JOB ORDERING SYSTEM</b></span>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="background-color: #d6e1e9;">
        <form method="post" id="pmh_form_edit">
            <div class="col-sm-12" style="display: inline-flex;">
             <div class="col-sm-6">
               <!-- <label>Job ID :</label><span style="display: inline-block; margin-left: 1%;"><div id="id_edit"></div></span> -->
               <label>Job No :</label><span style="display: inline-block; margin-left: 1%;"><div id="no_edit"></div></span>
               <input type="hidden" name="job_edit" id="job_edit"/>
             </div>
             <div class="col-sm-6">
             </div>
            </div>
            <hr>
            <div class="col-sm-12" style="display: inline-flex;">
             <div class="col-sm-3">
                <label>Customer :</label>
                <input type="text" name="customer_edit" id="customer_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
              </div>
              <div class="col-sm-3">
                <label>Accepted By :</label>
                <input type="text" name="accepted_by_edit" id="accepted_by_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
              </div>
              <div class="col-sm-3">
                <label>Checked By :</label>
                <input type="text" name="checked_by_edit" id="checked_by_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
              </div>
              <div class="col-sm-3">
                <label>Ordered Date :</label>
                <input type="text" name="date_edit" id="date_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
              </div>
            </div>
            <hr>
            <div class="col-sm-12" style="display: inline-flex;">
             <div class="col-sm-3">
               <label>Channel :</label>
               <input type="text" name="channel_edit" id="channel_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
             </div>
             <div class="col-sm-3">
                <label>Job Type :</label>
                <input type="text" name="type_edit" id="type_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
              <div class="col-sm-3">
                <label>Item :</label>
                <input type="text" name="product_edit" id="product_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
              <div class="col-sm-3">
                <label>Category :</label>
                <input type="text" name="category_edit" id="category_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
            </div>
            <div class="col-sm-12" style="display: inline-flex;">
              <div class="col-sm-3">
                <label>Quantity</label>
                <input type="text" name="quantity_edit" id="quantity_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
              <div class="col-sm-3">
                <label>Unit Price</label>
                <input type="text" name="unit_price_edit" id="unit_price_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
              <div class="col-sm-3">
                <label>Material</label>
                <input type="text" name="material_edit" id="material_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
              <div class="col-sm-3">
                <label>Size</label>
                <input type="text" name="size_edit" id="size_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div> 
            </div>
            <div class="col-sm-12" style="display: inline-flex;">
              <div class="col-sm-3">
                <label>Bind</label>
                <SELECT name="bind_edit" id="bind_edit" class="form-control" style="margin-bottom: 10px;" disabled>
                  <option value="None">None</option>
                  <option value="Spiral">Spiral</option>
                  <option value="Perfect">Perfect</option>
                  <option value="Tape">Tape</option>
                  <option value="Hard Cover">Hard Cover</option>
                </SELECT>
              </div> 
              <div class="col-sm-3">
                  <label>Color</label>
                  <input type="color" name="colour2" id="colour2" style="margin-bottom: 10px; width: 100%; height: 45%;"/>
                </div>
                <!-- <div class="col-sm-2">
                  <button type="button" id="color_edit_btn" name="color_edit_btn" class="btn btn-primary" onclick="getValue_edit()" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 35px; margin-left: 1.5%;">Add</button>
                </div> -->
                <div class="col-sm-4">
                  <br>
                  <textarea name="colour_edit" id="colour_edit" class="form-control" style="resize: vertical; margin-bottom: 10px;"></textarea>
               </div>
            </div> 
            <hr>
            <div class="col-sm-12" style="display: inline-flex;">
              <div class="col-sm-2">
                <label>Budget</label>
                <input type="text" name="budget_edit" id="budget_edit" class="form-control" style="margin-bottom: 10px;"readonly/>
              </div>
              <div class="col-sm-2">
                <label>Discount (%)</label>
                <input type="text" name="discount_edit" id="discount_edit" class="form-control" style="margin-bottom: 10px;"readonly/>
              </div>
              <div class="col-sm-2">
               <label>Discounted Price</label>
               <input type="text" name="discounted_edit" id="discounted_edit" class="form-control" style="margin-bottom: 10px;" readonly/>
              </div>
              <div class="col-sm-3">
               <label>Payment Advance </label>
               <input type="text" name="ad_pay_amount_edit" id="ad_pay_amount_edit" class="form-control" style="margin-bottom: 10px;"readonly/>
              </div>
             <div class="col-sm-3">
               <label>Rest Of the Budget</label>
               <input type="text" name="rest_edit" id="rest_edit" class="form-control" style="margin-bottom: 10px;" readonly />
             </div>
            </div>
            <hr>
            <div class="col-sm-12">
              <div class="col-sm-6" style="float: right;">
                <label>User description</label>
                  <textarea name="user_description_edit" id="user_description_edit" class="form-control" style="resize: vertical;" readonly></textarea>
              </div>
              <div class="col-sm-6">
                <label>Admin description</label>
                  <textarea name="admin_description_edit" id="admin_description_edit" class="form-control" style="resize: vertical;" readonly></textarea>
              </div>
            </div>

            <div class="col-sm-12" style="display: inline-flex; margin-top: 20px;">
             <div class="col-sm-3">
               <label>Cash</label>
               <input type="text" class="form-control" name="cash_edit" id="cash_edit" style="margin-bottom: 10px;" disabled>
             </div>
             <div class="col-sm-3">
               <label>Change</label>
                <input type="text" class="form-control" name="change_edit" id="change_edit" style="margin-bottom: 10px;" disabled>
             </div>
             <div class="col-sm-3">
               <label>Payment</label>
                <input type="text" class="form-control" name="payment_edit" id="payment_edit" style="margin-bottom: 10px;" disabled>
             </div>
             <div class="col-sm-3">
               <label>Dispatch Date</label>
                <input type="date" class="form-control" name="dispatch_day_edit" id="dispatch_day_edit" style="margin-bottom: 10px;" disabled>
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
