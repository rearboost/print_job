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
  <title>Job Ordering System - Web Setting</title>
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
        <li class="breadcrumb-item active">Trending Products</li>
      </ol>
      <div class="row">
      <div class="col-md-10">
      <!-- <input type="text" name="search_text" id="search_text" placeholder="Search by Job ID " class="form-control  form-control-sm" style="width: 40%;"/> -->
      </div>
      <div class="col-md-2">
        <button type="button" id="" name="" class="btn btn-primary btn-sm submit_data" data-toggle="modal" data-target="#myModal_trending" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px; margin-right:30px; float:right" ><font color="green"><b>+ </b></font> Trending Product</button>
      </div>
      </div>

      <!-- modal for Add New trending Product for web-->
    <div id="myModal_trending" class="modal fade">
    <div class="modal-dialog" style="max-width: 600px;">
      <div class="modal-content" style="height : auto;">
        <div class="modal-header" style="background-color: #507183;">
          <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW TRENDING PRODUCT</b></span>
          <button type="button" class="close" data-dismiss="modal" onclick="trending_form_reset()">&times;</button>
        </div>
        <div class="modal-body" style="background-color: #d6e1e9;">
          <form id="trending_submit" enctype="multipart/form-data">

            <?php
            $qry_tid = mysqli_query($conn, "SELECT id FROM web_trending_products ORDER BY id DESC LIMIT 1");
            $get_id = mysqli_fetch_array($qry_tid);
            $next_tid = $get_id['id']+1;
            ?>

            <div class="col-sm-12">
              <label>No</label>
              <input type="text" name="t_id" id="t_id" value="<?php echo $next_tid; ?>" class="form-control" style="margin-bottom: 10px;"/ readonly="">
            </div>

            <div class="col-sm-12">
              <label>Select Job Type</label>
              <SELECT name="jptype" id="jptype" class="form-control" style="margin-bottom: 10px;">
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
              <input type="text" name="T_product" id="T_product" class="form-control" style="margin-bottom: 20px;"/>
            </div>

            <div class="col-sm-12">
              <label>Price</label>
              <input type="text" name="price" id="price" class="form-control" style="margin-bottom: 20px;"/>
            </div>

            <div class="col-sm-12">
              <label>Image</label><br>
              <input type="file" name="t_image" id="t_image" style="margin-bottom: 20px;"/>
            </div>
              
            <div class="col-sm-12">
              <button type="button" id="form_trending_submit" name="form_trending_submit"  onclick="TrendingInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
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
   url:"../tables/web_trending_table.php",
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
function trending_form_reset(){
  document.getElementById("trending_submit").reset();
}
//////// add new catgory ///////
function TrendingInsert() {

  var formData = new FormData();

  var t_id =document.getElementById('t_id').value;
  var jptype =document.getElementById('jptype').value;
  var T_product =document.getElementById('T_product').value;
  var price =document.getElementById('price').value;

  var t_image = $('#t_image')[0].files[0]; 

  var form_trending_submit =document.getElementById('form_trending_submit').name;

  if(t_id=='' || jptype=='' || T_product=='' || price==''){
    alert("Required field is empty!");
  }
  else {

    formData.append('t_id', t_id);
    formData.append('jptype', jptype);
    formData.append('T_product', T_product);
    formData.append('price', price);
    formData.append('t_image', t_image);
    formData.append('form_trending_submit', form_trending_submit);


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
