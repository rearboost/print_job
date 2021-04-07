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
  <title>Job Ordering System - Inbound Requests</title>
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
        <li class="breadcrumb-item">
          <a href="web_settings">Web Setting</a>
        </li>
        <li class="breadcrumb-item active">Products</li>
      </ol>

      <div class="row">
      <div class="col-md-10">
      <!-- <input type="text" name="search_text" id="search_text" placeholder="Search by Job ID " class="form-control  form-control-sm" style="width: 40%;"/> -->
      </div>
      <div class="col-md-2">
        <button type="button" id="" name="" class="btn btn-primary btn-sm submit_data" data-toggle="modal" data-target="#myModal_product" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px; margin-right:30px; float:right" ><font color="green"><b>+ </b></font> New Product</button>
      </div>
      </div>

      <!-- modal for Add New Product for web-->
      <div id="myModal_product" class="modal fade">
      <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW PRODUCT</b></span>
            <button type="button" class="close" data-dismiss="modal" onclick="product_form_reset()">&times;</button>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form id="product_submit" enctype="multipart/form-data">

              <?php
              $qry_proid = mysqli_query($conn, "SELECT id FROM web_products ORDER BY id DESC LIMIT 1");
              $get_id = mysqli_fetch_array($qry_proid);
              $next_proid = $get_id['id']+1;
              ?>

              <div class="col-sm-12">
                <label>Product No</label>
                <input type="text" name="pro_id" id="pro_id" value="<?php echo $next_proid; ?>" class="form-control" style="margin-bottom: 10px;"/ readonly="">
              </div>

              <div class="col-sm-12">
                <label>Select Category</label>
                <SELECT name="jtype" id="jtype" class="form-control" style="margin-bottom: 10px;">
                  <option selected="" disabled="">Select Job Type</option>
                  <?php
                  $type = "SELECT *
                            FROM web_product_type ";

                  $result = mysqli_query($conn,$type);
                  $numRows = mysqli_num_rows($result); 

                    if($numRows > 0) {
                      while($row = mysqli_fetch_assoc($result)) {

                      echo '<option value = "'.$row["id"].'"> '. $row['id'] . ' | ' . $row['type'] .' </option>';
                        
                      }
                    }
                  ?>
                </SELECT>
              </div>

              <div class="col-sm-12">
                <label>Product Name</label>
                <input type="text" name="product" id="product" class="form-control" style="margin-bottom: 20px;"/>
              </div>

              <div class="col-sm-12">
                <label>Product Image</label><br>
                <input type="file" name="p_image" id="p_image" style="margin-bottom: 20px;"/>
              </div>

              <div class="col-sm-12">
                <button type="button" id="form_product_submit" name="form_product_submit"  onclick="ProductInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="snackbar"><p id="msg_view"></p></div>
      </div>

      <br>
       <!-- Inbound Requests table view -->
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


<!-- Inbound Requests table view in ajax -->
<script>

$(document).ready(function(){
 load_data();
 function load_data(query)
 {
  $.ajax({
   url:"../tables/web_product_table.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }

 $('#search_text').keyup(function(){
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
///////// reset form ///////////
function product_form_reset(){
  document.getElementById("product_submit").reset();
}
//////// add new catgory ///////
function ProductInsert() {

  var formData = new FormData();

  var pro_id =document.getElementById('pro_id').value;
  var jtype =document.getElementById('jtype').value;
  var product =document.getElementById('product').value;
  var p_image = $('#p_image')[0].files[0]; 

  var form_product_submit =document.getElementById('form_product_submit').name;

  if(pro_id=='' || jtype=='' || product=='' || p_image==''){
    alert("Required field is empty!");
  }
  else {

    formData.append('pro_id', pro_id);
    formData.append('jtype', jtype);
    formData.append('product', product);
    formData.append('p_image', p_image);
    formData.append('form_product_submit', form_product_submit);

    $.ajax({
          url: "../controller/web_product_controller.php",
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
// Message success view for type insert
function myform1() {
   var x = document.getElementById("snackbar");
   x.className = "show";
   setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

   // Location refech
   setTimeout(function(){location.reload(); },2500);
}
</script>
<!-- end -->
