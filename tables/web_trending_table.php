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
     $query = "SELECT * FROM web_trending_products WHERE id LIKE '%".$search."%' ";

  }
  else
  {
     $query = "SELECT * FROM web_trending_products";
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
     <th>Product</th>
     <th>Type</th>
     <th>Price</th>
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
     <td>'.$row["product"].'</td>
     <td>'.$row["type"].'</td>
     <td>'.$row["price"].'</td>
     <td><img src='.$_SESSION['basePath'].$row["image"].' height="64" width="77"></td>

      <td><button type="button"  id="' .$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModal_update_trending" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px;">View</button></td>

     <td style="width: 5%;"><a href="../controller/web_trending_controller?j_delete_id='.$row["id"].'" onclick="confirmation(event)">Delete</a></td>
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
         url:"../controller/web_trending_controller.php",
         method:"POST",
         data:{view_id:view_id},
         success:function(data){
           var data =JSON.parse(data);

           $('#t_id_edit').val(data['id']);
           $('#jptype_edit').val(data['type']);
           $('#T_product_edit').val(data['product']);
           $('#price_edit').val(data['price']);
           $('#type_img_edit').val(data['image']);
         }
    });
  });

  </script>

<div id="myModal_update_trending" class="modal fade">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-content" style="height : auto;">
        <div class="modal-header" style="background-color: #507183;">
          <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">UPDATE TRENDING PRODUCT</b></span>
          <button type="button" class="close" data-dismiss="modal" onclick="trending_form_reset()">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #d6e1e9;">
          <form id="trending_submit" enctype="multipart/form-data">
            <div class="col-sm-12">
              <label>No</label>
              <input type="text" name="t_id_edit" id="t_id_edit" class="form-control" style="margin-bottom: 10px;"/ readonly="">
            </div>

            <div class="col-sm-12">
              <label>Select Job Type</label>
              <SELECT name="jptype_edit" id="jptype_edit" class="form-control" style="margin-bottom: 10px;">
                <option selected="" disabled="">Select Job Type</option>
                <?php
                $type = "SELECT *
                          FROM web_product_type";

                $result = mysqli_query($conn,$type);
                $numRows = mysqli_num_rows($result); 

                  if($numRows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {

                    echo '<option value = "'.$row["type"].'"> '. $row['type'] .' </option>';
                      
                    }
                  }
                ?>
              </SELECT>
            </div>

            <div class="col-sm-12">
              <label>Product</label>
              <input type="text" name="T_product_edit" id="T_product_edit" class="form-control" style="margin-bottom: 20px;"/>
            </div>

            <div class="col-sm-12">
              <label>Price</label>
              <input type="text" name="price_edit" id="price_edit" class="form-control" style="margin-bottom: 20px;"/>
            </div>

            <div class="col-sm-12">
              <label>Image</label><br>
              <input type="file" name="t_image_edit" id="t_image_edit" style="margin-bottom: 20px;"/>
            </div>
              
            <div class="col-sm-12">
              <button type="button" id="form_trending_edit" name="form_trending_edit"  onclick="Formedit()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">UPDATE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="snackbar"><p id="msg_view"></p></div>
    </div>

 <script>

 function trending_form_reset(){
  document.getElementById("trending_submit").reset();
 }

 function Formedit() {

  var formData = new FormData();

  var t_id_edit =document.getElementById('t_id_edit').value;
  var jptype_edit =document.getElementById('jptype_edit').value;
  var T_product_edit =document.getElementById('T_product_edit').value;
  var price_edit =document.getElementById('price_edit').value;

  var t_image_edit = $('#t_image_edit')[0].files[0]; 

  var form_trending_edit =document.getElementById('form_trending_edit').name;

  if(t_id_edit=='' || jptype_edit=='' || T_product_edit=='' || price_edit==''){
    alert("Required field is empty!");
  }
  else {

    formData.append('t_id_edit', t_id_edit);
    formData.append('jptype_edit', jptype_edit);
    formData.append('T_product_edit', T_product_edit);
    formData.append('price_edit', price_edit);
    formData.append('t_image_edit', t_image_edit);
    formData.append('form_trending_edit', form_trending_edit);


    $.ajax({
          url: "../controller/web_trending_controller.php",
          contentType: false,
          processData: false,
          dataType: 'text', 
          data: formData,               
          type: "POST",
          success:function(data){
               myform1();
              $('#msg_view').html(data);
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

  $(document).ready(function() {
      $('#example').DataTable();
  } );
</script>
