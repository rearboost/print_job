<DOCTYPE html>
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

       $view_status ="reject";

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
      <table id="example" class="table table-striped table-bordered" style="width:100%">
       <thead>
        <tr>
         <th>#</th>
         <th>Job No</th>
         <th>Customer</th>
         <th>Item</th>
         <th>Material</th>
         <th>Admin Description</th>
         <th>User Description</th>
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
         <td style="width: 10%;">'.$row["id"].'</td>
         <td>'.$row["job_no"].'</td>
         <td>'.$row["customer"].'</td>
         <td>'.$row["product"].'</td>
         <td>'.$row["material"].'</td>
         <td>'.$row["admin_description"].'</td>
         <td>'.$row["user_description"].'</td>
         <td><button type="button"  id="'.$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModalcomplete" style="border: 0px; color: #ffffff; font-size: 14px; padding-top: 1px;">View</button></td>
         <td><button type="button" class="btn btn-primary btn-sm" onclick="confirmation(event ,'.$row["id"].')" style="border: 0px; color: #ffffff; font-size: 14px; padding-top: 1px;">Delete</button></td>
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
     <div id="snackbar">Success!  Remove </div>
  </body>
  </html>
  <script>

  // Delete Conformation function
  function confirmation(e,id) {
       var answer = confirm("Are you sure you want to permanently delete this record?")
    if (!answer){
      e.preventDefault();
      return false;
    }
    else
    {

      $.ajax({
           url:"../controller/rejected_controller.php",
           method:"POST",
           data:{reject_delete_id:id},
           success:function(data){
              myform2();
           }
      });

    }
 }

  // Message success view
  function myform2() {
      var x = document.getElementById("snackbar");
      x.className = "show";
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

      // Location refech
      setTimeout(function(){location.reload(); },3000);
  }

  // Modal load value in jquery
  $(document).on('click', '.view_data', function(){

    var view_id = $(this).attr("name");

    $.ajax({
         url:"../controller/rejected_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
            //$('#comment_val').html(data);
           var data =JSON.parse(data);

           $('#job_edit').val(data['id']);
           $('#job_no_edit').val(data['job_no']);
           $('#customer_edit').val(data['customer']);
           $('#accepted_by_edit').val(data['accepted_by']);
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
           $('#admin_description_edit').val(data['admin_description']);
         }
    });

  });
  </script>

<!-- Complete From Modal -->
<div id="myModalcomplete" class="modal fade">
  <div class="modal-dialog" style="max-width: 1000px;">
    <div class="modal-content" style="height : auto;">
        <div class="modal-header" style="background-color: #507183;">
        <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">Rejected</b></span>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="background-color: #d6e1e9;">
        <form method="post" id="pmh_form_edit">
           <div class="col-sm-12" style="display: inline-flex;">
           <div class="col-sm-4">
             <label>Job No :</label>
             <input type="text" name="job_no_edit" id="job_no_edit" class="form-control" style="margin-bottom: 10px;"/ >
             <input type="hidden" name="job_edit" id="job_edit"/>
           </div>
           <div class="col-sm-4">
              <label>Customer :</label>
              <input type="text" name="customer_edit" id="customer_edit" class="form-control" style="margin-bottom: 10px;"/ >
            </div>
            <div class="col-sm-4">
              <label>Accepted By :</label>
              <input type="text" name="accepted_by_edit" id="accepted_by_edit" class="form-control" style="margin-bottom: 10px;"/ >
            </div>
          </div>
          <hr>
          <div class="col-sm-12" style="display: inline-flex;">
           <div class="col-sm-3">
             <label>Channel :</label>
             <input type="text" name="channel_edit" id="channel_edit" class="form-control" style="margin-bottom: 10px;"/ >
           </div>
           <div class="col-sm-3">
              <label>Job Type :</label>
              <input type="text" name="type_edit" id="type_edit" class="form-control" style="margin-bottom: 10px;"/ >
            </div>
            <div class="col-sm-3">
              <label>Item :</label>
              <input type="text" name="product_edit" id="product_edit" class="form-control" style="margin-bottom: 10px;"/ >
            </div>
            <div class="col-sm-3">
              <label>Category :</label>
              <input type="text" name="category_edit" id="category_edit" class="form-control" style="margin-bottom: 10px;"/ >
            </div>
          </div>
          <div class="col-sm-12" style="display: inline-flex;">
            <div class="col-sm-3">
              <label>Quantity</label>
              <input type="text" name="quantity_edit" id="quantity_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-3">
              <label>Unit Price</label>
              <input type="text" name="unit_price_edit" id="unit_price_edit" class="form-control" style="margin-bottom: 10px;" disabled/>
            </div>
            <div class="col-sm-3">
              <label>Material</label>
              <input type="text" name="material_edit" id="material_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
            <div class="col-sm-3">
              <label>Size</label>
              <input type="text" name="size_edit" id="size_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div> 
          </div>
          
          <div class="col-sm-12" style="display: inline-flex;">
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
             <input type="text" name="discounted_edit" id="discounted_edit" class="form-control" style="margin-bottom: 10px;" />
            </div>
          </div>
          <div class="col-sm-12" style="display: inline-flex;">
            <div class="col-sm-4">
             <label>Payment Advance </label>
             <input type="text" name="ad_pay_amount_edit" id="ad_pay_amount_edit" class="form-control" style="margin-bottom: 10px;"/>
            </div>
           <div class="col-sm-4">
             <label>Rest Of the Budget</label>
             <input type="text" name="rest_edit" id="rest_edit" class="form-control" style="margin-bottom: 10px;" />
           </div>
           <div class="col-sm-4">
             <label>Date</label>
             <input type="date" name="date_edit" id="date_edit" class="form-control" style="margin-bottom: 10px;" />
           </div>
          </div>
          <div class="col-sm-12">
            <div class="col-sm-6">
              <label>Admin description</label>
                <textarea name="admin_description_edit" id="admin_description_edit" class="form-control" style="resize: vertical;"></textarea>
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