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

   $view_status ="request";

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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <div class="tablealign">
<!--  <script src="jquery.tabledit.min.js"></script> -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php include('../include/head.php'); ?>
  <table id="editable_table" class="table table table-striped">
   <thead>
    <tr>
     <th>Job ID</th>
     <th>Job No</th>
     <th>Customer</th>
     <th>Channel</th>
     <th>Type</th>
     <th>Item</th>
     <th>Material</th>
     <th>Admin Description</th>
     <th></th>
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
     <td style="width: 7%;">'.$row["id"].'</td>
     <td>'.$row["job_no"].'</td>
     <td>'.$row["customer"].'</td>
     <td>'.$row["channel"].'</td>
     <td>'.$row["job_type"].'</td>
     <td>'.$row["product"].'</td>
     <td>'.$row["material"].'</td>
     <td>'.$row["admin_description"].'</td>

      <td><button type="button"  id="' .$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModal" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px;">View</button></td>

     <td style="width: 5%;"><a href="../controller/inbound_requests_controller?j_delete_id='.$row["id"].'" onclick="confirmation(event)">Delete</a></td>
    </tr>
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

  // Delete Conformation function
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
         url:"../controller/inbound_requests_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
            //$('#comment_val').html(data);
           var data =JSON.parse(data);

           //$('#id_edit').html(data['id']);
           $('#job_edit').val(data['id']);
           $('#job_no_edit').val(data['job_no']);
           $('#customer_edit').val(data['customer']);
           $('#accepted_by_edit').val(data['accepted_by']);
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
           $('#user_description_edit').val(data['user_description']);
           $('#admin_description_edit').val(data['admin_description']);
         }
    });
  });

  </script>

<!-- Edid From  Past medical history Modal -->
 <div id="myModal" class="modal fade">
    <div class="modal-dialog" style="max-width: 1000px;">
     <div class="modal-content" style="height : auto;">
        <div class="modal-header" style="background-color: #507183;">
             <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">Inbound Request</b></span>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #d6e1e9;">
         <form method="post" id="pmh_form_edit">
          <div class="col-sm-12" style="display: inline-flex;">
           <div class="col-sm-4">
             <label>Job No :</label>
             <input type="text" name="job_no_edit" id="job_no_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
             <input type="hidden" name="job_edit" id="job_edit"/>
           </div>
           <div class="col-sm-4">
              <label>Customer :</label>
              <input type="text" name="customer_edit" id="customer_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
            </div>
            <div class="col-sm-4">
              <label>Accepted By :</label>
              <input type="text" name="accepted_by_edit" id="accepted_by_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
            </div>
          </div>
          <hr>
          <div class="col-sm-12" style="display: inline-flex;">
           <div class="col-sm-3">
             <label>Channel :</label>
             <input type="text" name="channel_edit" id="channel_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
           </div>
           <div class="col-sm-3">
              <label>Job Type :</label>
              <input type="text" name="type_edit" id="type_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
            </div>
            <div class="col-sm-3">
              <label>Item :</label>
              <input type="text" name="product_edit" id="product_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
            </div>
            <div class="col-sm-3">
              <label>Category :</label>
              <input type="text" name="category_edit" id="category_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
            </div>
          </div>
          <div class="col-sm-12" style="display: inline-flex;">
            <div class="col-sm-3">
              <label>Quantity</label>
              <input type="text" name="quantity_edit" id="quantity_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-3">
              <label>Material</label>
              <input type="text" name="material_edit" id="material_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-3">
              <label>Size</label>
              <input type="text" name="size_edit" id="size_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-3">
              <label>Bind</label>
              <SELECT name="bind_edit" id="bind_edit" class="form-control" style="margin-bottom: 10px;">
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
            <div class="col-sm-4">
              <label>Budget</label>
              <input type="text" name="budget_edit" id="budget_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-4">
              <label>Discount (%)</label>
              <input type="text" name="discount_edit" id="discount_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-4">
             <label>Discounted Price</label>
             <input type="text" name="discounted_edit" id="discounted_edit" class="form-control" style="margin-bottom: 10px;" readonly/>
            </div>
          </div>
          <div class="col-sm-12" style="display: inline-flex;">
            <div class="col-sm-4">
             <label>Payment Advance </label>
             <input type="text" name="ad_pay_amount_edit" id="ad_pay_amount_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
           <div class="col-sm-4">
             <label>Rest Of the Budget</label>
             <input type="text" name="rest_edit" id="rest_edit" class="form-control" style="margin-bottom: 10px;" readonly />
           </div>
           <div class="col-sm-4">
             <label>Date</label>
             <input type="date" name="date_edit" id="date_edit" class="form-control" style="margin-bottom: 10px;" />
           </div>
          </div>
          <div class="col-sm-12">
            <div class="col-sm-6" style="float: right;">
              <label>User description</label>
                <textarea name="user_description_edit" id="user_description_edit" class="form-control" style="resize: vertical;" readonly></textarea>
            </div>
            <div class="col-sm-6">
              <label>Admin description</label>
                <textarea name="admin_description_edit" id="admin_description_edit" class="form-control" style="resize: vertical;"></textarea>
            </div>
          </div>
          <div class="col-sm-12" style="margin-bottom: 20px;">
           <div class="col-sm-6">
             <label>Status</label>
             <select  class="form-control" name="status_edit" id="status_edit">
               <option value="">Select</option>
               <option value="design">Design</option>
               <option value="reject">Reject</option>
            </select>
           </div>
          </div>
          <div class="col-sm-12">
              <button type="button" id="from_btn_edit" name="from_btn_edit"  onclick="Formedit()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 12px;  padding: 4px 10px; margin-top: 0px;     margin-left: 1.5%;">Edit</button>
          </div>
         </form>
        </div>
     </div>
    </div>
     <div id="snackbar">Success! Update Data</div>
 </div>



 <script>

  // Calulate Amount about  to the budget
  $("#budget_edit").keyup(function(){

    var budget_edit =document.getElementById('budget_edit').value;
    $('#rest_edit').val(budget_edit);
    $('#discounted_edit').val(budget_edit);

  });

  // Calulate Amount about  to the discount add
  $("#discount_edit").keyup(function(){

   var budget_edit =document.getElementById('budget_edit').value;
   var discount_edit =document.getElementById('discount_edit').value;


   var discount =(discount_edit*budget_edit/100).toFixed(2);

   var budget_edit =parseFloat(budget_edit)- parseFloat(discount);

   if(budget_edit<0){
     budget_edit =0;
   }
   $('#discounted_edit').val(budget_edit);
   $('#rest_edit').val(budget_edit);


  });

  // Calulate Amount about  to the tax diduction

  $("#ad_pay_amount_edit").keyup(function(){

    var discounted =document.getElementById('discounted_edit').value;
    var ad_amount  =document.getElementById('ad_pay_amount_edit').value;

    var rest_amt = parseFloat(discounted) - parseFloat(ad_amount);

    $('#rest_edit').val(rest_amt);

  });

 function Formedit() {


    var job_edit =document.getElementById('job_edit').value;

    var quantity_edit =document.getElementById('quantity_edit').value;
    var material_edit =document.getElementById('material_edit').value;
    var size_edit =document.getElementById('size_edit').value;
    var bind_edit =document.getElementById('bind_edit').value;
    // var colour_edit =document.getElementById('colour_edit').value;

    var budget_edit =document.getElementById('budget_edit').value;
    var discount_edit =document.getElementById('discount_edit').value;
    var discounted_edit =document.getElementById('discounted_edit').value;
    var ad_pay_amount_edit =document.getElementById('ad_pay_amount_edit').value;
    var rest_edit =document.getElementById('rest_edit').value;
    var date_edit =document.getElementById('date_edit').value;

    var admin_description_edit =document.getElementById('admin_description_edit').value;

    var status_edit =document.getElementById('status_edit').value;
    var status_editcheck =document.getElementById('status_edit').value;

    var from_btn_edit =document.getElementById('from_btn_edit').name;


  if(status_editcheck==''){
    alert("Status Filed is Required");
  }
  else {

       $.ajax({
         url:"../controller/inbound_requests_controller.php",
         method:"POST",
         data:{job_edit:job_edit,quantity_edit:quantity_edit,material_edit:material_edit,size_edit:size_edit,bind_edit:bind_edit,budget_edit:budget_edit,discount_edit:discount_edit,discounted_edit:discounted_edit,ad_pay_amount_edit:ad_pay_amount_edit,rest_edit:rest_edit,date_edit:date_edit,admin_description_edit:admin_description_edit,status_edit:status_edit,from_btn_edit:from_btn_edit},
         success:function(data){

         // Message success call function
          myform1();

         }
      });
  }

 }

 // Message success view
 function myform1() {
     var x = document.getElementById("snackbar");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

     // Location refech
     setTimeout(function(){location.reload(); },2500);
 }




 </script>