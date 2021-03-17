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

       $view_status ="design";

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
     <th>Channel</th>
     <th>Type</th>
     <th>Item</th>
     <th>Material</th>
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
     <td>'.$row["channel"].'</td>
     <td>'.$row["job_type"].'</td>
     <td>'.$row["product"].'</td>
     <td>'.$row["material"].'</td>
     <td><button type="button" id="'.$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModaldesign" style="border: 0px; color: #ffffff; font-size: 14px; padding-top: 1px;">View</button></td>';
    
      echo  '<td><button type="button"  onclick="addproduction('.$row["id"].')" class="btn btn-primary btn-sm" style="border: 0px; color: #ffffff; font-size: 14px; padding-top: 1px;">Add To Production</button></td>';
   
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
  function addproduction(id) {

      $.ajax({
        url:"../controller/design_controller.php",
        method:"POST",
        data:{addproduction_job_edit:id},
        success:function(data){

        // Message success call function
           myformaddp();
           $('#msg_view').html(data);
        }
     });
   }


   // Message success view
   function myformaddp() {
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
         url:"../controller/design_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
            //$('#comment_val').html(data);
           var data =JSON.parse(data);

           $('#id_edit').html(data['id']);
           $('#no_edit').html(data['job_no']);

           $('#job_edit').val(data['id']);
           $('#job_no_edit').val(data['job_no']);
           $('#channel_edit').val(data['channel']);
           $('#type_edit').val(data['job_type']);
           $('#product_edit').val(data['product']);
           $('#category_edit').val(data['category']);
           $('#quantity_edit').val(data['quantity']);
           $('#material_edit').val(data['material']);
           $('#size_edit').val(data['size']);
           $('#bind_edit').val(data['bind']);
           $('#colour_edit').val(data['colour']);
           $('#user_description_edit').val(data['user_description']);
           $('#admin_description_edit').val(data['admin_description']);
         }
    });
  });

</script>

<div id="myModaldesign" class="modal fade">
  <div class="modal-dialog" style="max-width: 1000px;">
     <div class="modal-content" style="height : auto;">
        <div class="modal-header" style="background-color: #507183;">
           <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">Design</b></span>
           <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #d6e1e9;">
           <form method="post" id="pmh_form_edit">
              <div class="col-sm-12" style="display: inline-flex;">
               <div class="col-sm-6">
                 <!-- <label>Job ID :</label><span style="display: inline-block; margin-left: 1%;"><div id="id_edit"></div></span> -->
                 <label>Job No :</label><span style="display: inline-block; margin-left: 1%;"><div id="no_edit"></div></span>
                 <input type="hidden" name="job_edit" id="job_edit">
               </div>
               <div class="col-sm-6">
               </div>
              </div>
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
                  <input type="text" name="quantity_edit" id="quantity_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
                </div>
                <div class="col-sm-3">
                  <label>Material</label>
                  <input type="text" name="material_edit" id="material_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
                </div>
                <div class="col-sm-3">
                  <label>Size</label>
                  <input type="text" name="size_edit" id="size_edit" class="form-control" style="margin-bottom: 10px;"/ disabled>
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
              <div class="col-sm-12" style="display: inline-flex;">
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
              <div class="col-sm-12">
                <div class="col-sm-6" style="float: right;">
                  <label>User description</label>
                    <textarea name="user_description_edit" id="user_description_edit" class="form-control" style="resize: vertical; margin-bottom: 10px;" ></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Admin description</label>
                    <textarea name="admin_description_edit" id="admin_description_edit" class="form-control" style="resize: vertical; margin-bottom: 10px;"readonly></textarea>
                </div>
              </div>  
               
              <div class="col-sm-12">
              <button type="button" id="from_btn_edit" name="from_btn_edit"  onclick="FormDesign()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 12px;  padding: 4px 10px; margin-top: 0px;     margin-left: 1.5%;">Edit</button>
              </div>
           </form>
        </div>
     </div>
  </div>
  <div id="snackbar"><p id="msg_view"></p></div>
</div>

<script>
function FormDesign() {

  var job_edit =document.getElementById('job_edit').value;

  var user_description_edit =document.getElementById('user_description_edit').value;

  var from_btn_edit =document.getElementById('from_btn_edit').name;

  $.ajax({
    url:"../controller/design_controller.php",
    method:"POST",
    data:{job_edit:job_edit,user_description_edit:user_description_edit,from_btn_edit:from_btn_edit},
    success:function(data){

    // Message success call function
    myform1();
    $('#msg_view').html(data);
    }
  });
}

 // Message success view
 function myform1() {
     var x = document.getElementById("snackbar");
     x.className = "show";
     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

     // Location refech
     setTimeout(function(){location.reload(); },2500);
 }

 //  Insert Into the textarea 
 function getValue_edit(){
      var x = document.getElementById("colour2").value;
      var textarea = document.getElementById('colour_edit');
      textarea.value = textarea.value +x +'\n';
  }

   // Pushed to the arry multiple color codes 
  function setEditArry(){
    var array=[];
    var lines = $('#colour_edit').val().split('\n');
    $.each(lines, function(i){
      array.push({no:i,code:this});
    });
    array.splice(-1,1)
    console.log(JSON.stringify(array, null, 1));
    $('#myitemjson_edit').val(JSON.stringify(array));
  }

  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>
