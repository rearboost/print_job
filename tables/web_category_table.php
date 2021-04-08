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
     $query = "SELECT * FROM web_product_type WHERE id LIKE '%".$search."%' ";

  }
  else
  {
     $query = "SELECT * FROM web_product_type";
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
     <th>Category</th>
     <th>Image</th>
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
     <td>'.$row["type"].'</td>
     <td><img src='.$_SESSION['basePath'].$row["image"].' height="64" width="77"></td>

      <td><button type="button"  id="' .$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModal_type_update" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px;">View</button></td>

     <td style="width: 5%;"><a href="../controller/web_category_controller?j_delete_id='.$row["id"].'" onclick="confirmation(event)">Delete</a></td>
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
    var imgUrl = '<?php echo $_SESSION['basePath']; ?>';

    $.ajax({
         url:"../controller/web_category_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
           var data =JSON.parse(data);

           $('#cat_id_edit').val(data['id']);
           $('#job_type_edit').val(data['type']);
           $("#image_edit").attr("src",imgUrl+data['image']);

         }
    });
  });

  </script>

<div id="myModal_type_update" class="modal fade">
<div class="modal-dialog" style="max-width: 600px;">
  <div class="modal-content" style="height : auto;">
    <div class="modal-header" style="background-color: #507183;">
      <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">UPDATE CATEGORY</b></span>
      <button type="button" class="close" data-dismiss="modal" onclick="type_form_reset()">&times;</button>
    </div>
    <div class="modal-body" style="background-color: #d6e1e9;">
      <form id="type_submit" enctype="multipart/form-data">
        <div class="col-sm-12">
          <label> Category No</label>
          <input type="text" name="cat_id_edit" id="cat_id_edit" class="form-control" style="margin-bottom: 10px;" readonly="">
        </div>
        <div class="col-sm-12">
          <label>Category</label>
          <input type="text" name="job_type_edit" id="job_type_edit" class="form-control" style="margin-bottom: 20px;"/>
        </div>
        <div class="col-sm-12">
          <label>Image</label><br>
           <input type="file" name="type_img_edit" id="type_img_edit" style="margin-bottom: 20px;" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" />
           
        </div>
        <div class="col-sm-12">
            <img id="output" src="../image/default-image.jpg" width="100" height="100">
            <img id="image_edit" src="../image/default-image.jpg" width="100" height="100">
        </div>
        <br>
        <div class="col-sm-12">
          <button type="button" id="form_type_edit" name="form_type_edit"  onclick="Formedit()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">UPDATE</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- <div id="snackbar_edit"><p id="msg_view_edit"></p></div> -->
</div>

 <script>

 function type_form_reset(){
  document.getElementById("type_submit").reset();
 }

 function Formedit() {

  var formData = new FormData();

  var cat_id_edit =document.getElementById('cat_id_edit').value;
  var job_type_edit =document.getElementById('job_type_edit').value;

  var type_img_edit = $('#type_img_edit')[0].files[0]; 

  var form_type_edit =document.getElementById('form_type_edit').name;

  if(cat_id_edit=='' || job_type_edit==''){
    alert("Required field is empty!");
  }
  else {

    formData.append('cat_id_edit', cat_id_edit);
    formData.append('job_type_edit', job_type_edit);
    formData.append('type_img_edit', type_img_edit);
    formData.append('form_type_edit', form_type_edit);

    $.ajax({
          url: "../controller/web_category_controller.php",
          contentType: false,
          processData: false,
          dataType: 'text', 
          data: formData,               
          type: "POST",
          success:function(data){
             
             // myform1();
              alert(data)
              //$('#msg_view').html(data);
              setTimeout(function(){location.reload(); },2500);
          }
  });
  }
 }

  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>
