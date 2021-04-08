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
        <li class="breadcrumb-item active">Job category</li>
      </ol>
      <div class="row">
      <div class="col-md-10">
      <!-- <input type="text" name="search_text" id="search_text" placeholder="Search by Job ID " class="form-control  form-control-sm" style="width: 40%;"/> -->
      </div>
      <div class="col-md-2">
        <button type="button" id="" name="" class="btn btn-primary btn-sm submit_data" data-toggle="modal" data-target="#myModal_type" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px; margin-right:30px; float:right" ><font color="green"><b>+ </b></font> New Category</button>
      </div>
      </div>

      <!-- modal for Add New Job type for web setting-->
      <div id="myModal_type" class="modal fade">
      <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW CATEGORY</b></span>
            <button type="button" class="close" data-dismiss="modal" onclick="type_form_reset()">&times;</button>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form id="type_submit" enctype="multipart/form-data">
              <?php
              $qry_jobid = mysqli_query($conn, "SELECT id FROM web_product_type ORDER BY id DESC LIMIT 1");
              $get_id = mysqli_fetch_array($qry_jobid);
              $next_id = $get_id['id']+1;
              ?>

              <div class="col-sm-12">
                <label> Category No</label>
                <input type="text" name="job_id" id="job_id" value="<?php echo $next_id; ?>" class="form-control" style="margin-bottom: 10px;"/ readonly="">
              </div>
              <div class="col-sm-12">
                <label>Category</label>
                <input type="text" name="job_type" id="job_type" class="form-control" style="margin-bottom: 20px;"/>
              </div>
              <div class="col-sm-12">
                <label>Image</label> <br>
                <input type="file" name="type_img" id="type_img" style="margin-bottom: 20px;" accept="image/*" onchange="document.getElementById('output1').src = window.URL.createObjectURL(this.files[0])"/>
                 <img id="output1" src="../image/default-image.jpg" width="100" height="100">
              </div>
              <div class="col-sm-12">
                <button type="button" id="form_type_submit" name="form_type_submit"  onclick="TypeInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
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
   url:"../tables/web_category_table.php",
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
function type_form_reset(){
  document.getElementById("type_submit").reset();
}
//////// add new catgory ///////
function TypeInsert() {

  var formData = new FormData();

  var job_id =document.getElementById('job_id').value;
  var job_type =document.getElementById('job_type').value;
  //var type_img =document.getElementById('type_img').value;
  var type_img = $('#type_img')[0].files[0]; 

  var form_type_submit =document.getElementById('form_type_submit').name;

  if(job_id=='' || job_type=='' || type_img==''){
    alert("Required field is empty!");
  }
  else {

    formData.append('job_id', job_id);
    formData.append('job_type', job_type);
    formData.append('type_img', type_img);
    formData.append('form_type_submit', form_type_submit);

    $.ajax({
          url: "../controller/web_category_controller.php",
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
