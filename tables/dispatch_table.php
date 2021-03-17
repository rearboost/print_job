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

       $view_status ="dispatch";

      if(isset($_POST["query"]))
      {
         $search =$_POST["query"];
         $query = "SELECT * FROM jobs WHERE state='$view_status' AND id LIKE '%".$search."%' ";

      }
      else
      {
         $query = "SELECT * FROM jobs WHERE state='$view_status'";
      }
      $result = mysqli_query($conn ,$query);

      if(mysqli_num_rows($result)>0)
      {
        ?>

     <div class="tablealign">
    <!--  <script src="jquery.tabledit.min.js"></script> -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <?php include('../include/head.php'); ?>
      <table id="example" class="table table-striped table-bordered" style="width:100%">
       <thead>
        <tr>
         <th>#</th>
         <th>Job No</th>
         <th>Customer</th>
         <th>Item</th>
         <th>Rest</th>
         <th>Payment</th>
         <th></th>
         <th style="width: 14%;"></th>
        </tr>
       </thead>
       <tbody>
       <?php
       $i=1;
       while($row = mysqli_fetch_array($result))
       {
        echo '
        <tr>
         <td style="width: 10%;">'.$row["id"].'</td>
         <td>'.$row["job_no"].'</td>
         <td>'.$row["customer"].'</td>
         <td>'.$row["product"].'</td>
         <td>'.$row["rest"].'</td>
         <td>'.$row["payment"].'</td>
         <td><button type="button" id="'.$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModaldispatch" style="border: 0px; color: #ffffff; font-size: 14px; padding-top: 1px;">View</button></td>';

        if($row["payment"]>=$row["rest"]){
          echo  '<td><button type="button"  onclick="addcomplete('.$row["id"].')" class="btn btn-primary btn-sm" style="border: 0px; color: #ffffff; font-size: 14px; padding-top: 1px;">Add To Complete</button></td>';
        }
        else {
          echo  '<td><button type="button"  onclick="addcomplete('.$row["id"].')" class="btn btn-primary btn-sm tooltip" style="border: 0px; color: #ffffff; font-size: 14px; padding-top: 1px;" disabled>Add To Complete</button></td>';
        }
        echo '</tr>';

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
   <div id="snackbar"><p id="msg_view"></p></div>
  </body>
  </html>
  <script>
  function addcomplete(id) {

      $.ajax({
        url:"../controller/dispatch_controller.php",
        method:"POST",
        data:{addcomplete_job_edit:id},
        success:function(data){

        // Message success call function
           myformaddc();
           $('#msg_view').html(data);
        }
     });
   }


   // Message success view
   function myformaddc() {
       var x = document.getElementById("snackbar");
       x.className = "show";
       setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

       // Location refech
       setTimeout(function(){location.reload(); },3100);
   }


  // Modal load value in jquery
  $(document).on('click', '.view_data', function(){

    var view_id = $(this).attr("name");

    $.ajax({
         url:"../controller/dispatch_controller.php",
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

<!-- Dispatch From Modal -->
 <div id="myModaldispatch" class="modal fade">
  <div class="modal-dialog" style="max-width: 1000px;">
     <div class="modal-content" style="height : auto;">
      <div class="modal-header" style="background-color: #507183;">
       <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">Dispatch</b></span>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="background-color: #d6e1e9;">
       <form method="post" id="pmh_form_edit">
            <div class="col-sm-12" style="display: inline-flex;">
             <div class="col-sm-6">
               <label>Job ID :</label><span style="display: inline-block; margin-left: 1%;"><div id="id_edit"></div></span>
               <input type="hidden" name="job_edit" id="job_edit"/>
             </div>
             <div class="col-sm-6">
               <label>Job No :</label><span style="display: inline-block; margin-left: 1%;"><div id="no_edit"></div></span>
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
                <label>Material</label>
                <input type="text" name="material_edit" id="material_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
              <div class="col-sm-3">
                <label>Size</label>
                <input type="text" name="size_edit" id="size_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
              </div>
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
               <input type="text" class="form-control" name="cash_edit" id="cash_edit" style="margin-bottom: 10px;" required>
             </div>
             <div class="col-sm-3">
               <label>Change</label>
                <input type="text" class="form-control" name="change_edit" id="change_edit" style="margin-bottom: 10px;" required disabled="">
             </div>
             <div class="col-sm-3">
               <label>Payment</label>
                <input type="text" class="form-control" name="payment_edit" id="payment_edit" style="margin-bottom: 10px;" required disabled="">
             </div>
             <div class="col-sm-3">
               <label>Dispatch Date</label>
                <input type="date" class="form-control" name="dispatch_day_edit" id="dispatch_day_edit" style="margin-bottom: 10px;" required>
             </div>
            </div>

            <div class="col-sm-12" style="margin-bottom: 20px;">
              <button type="button" id="form_bill" name="form_bill"  onclick="bill()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">Bill</button>
           </div>
       </form>
      </div>
     </div>
  </div>
  <div id="snackbar"><p id="msg_view"></p></div>
 </div>

 <script>

  $("#cash_edit").keyup(function(){

    var cash_edit =document.getElementById('cash_edit').value;
    var rest_edit =document.getElementById('rest_edit').value;

    var change_edit =parseFloat(cash_edit)- parseFloat(rest_edit);

    $('#change_edit').val(change_edit.toFixed(2));
    $('#payment_edit').val(rest_edit);

  });

 //////////////////////////////////////////

  function bill() {

    var job_edit =document.getElementById('job_edit').value;

    var rest_edit =document.getElementById('rest_edit').value;
    var cash_edit =document.getElementById('cash_edit').value;
    var change_edit =document.getElementById('change_edit').value;
    var payment_edit =document.getElementById('payment_edit').value;
    var dispatch_day_edit =document.getElementById('dispatch_day_edit').value;

    var form_bill =document.getElementById('form_bill').name;


  if(cash_edit=='' || dispatch_day_edit==''){
    alert("Required Fieled is empty");
  }
  else {

       $.ajax({
         url:"../controller/dispatch_controller.php",
         method:"POST",
         data:{job_edit:job_edit,rest_edit:rest_edit,cash_edit:cash_edit,change_edit:change_edit,payment_edit:payment_edit,dispatch_day_edit:dispatch_day_edit,form_bill:form_bill},
         success:function(data){

         // Message success call function
          myformpay();
          $('#msg_view').html(data);
         }
      });
  }

 }

 // Message success view
 function myformpay() {

     var printId = $('#job_edit').val();
   
     var x = document.getElementById("snackbar");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

     
     //// Location refech
     setTimeout(function(){window.open('../tables/invoice_print?id='+printId, '_blank'); }, 2500);
     setTimeout(function(){location.reload(); },2500);
 }

  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>