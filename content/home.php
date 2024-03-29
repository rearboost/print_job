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
  <title>Job Ordering System -  Home</title>
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>


      <?php
           $query1 ="SELECT COUNT(id) as iid FROM customer";
           $result1 =mysqli_query($conn,$query1);
           while ($row1 =mysqli_fetch_array($result1))
           {
              $customer =$row1['iid'];
           }
      ?>

      <?php
           $query2 ="SELECT COUNT(id) as iid FROM product";
           $result2 =mysqli_query($conn,$query2);
           while ($row2 =mysqli_fetch_array($result2))
           {
              $product =$row2['iid'];
           }
      ?>

      <?php
           $query3 ="SELECT COUNT(id) as iid FROM signup";
           $result3 =mysqli_query($conn,$query3);
           while ($row3 =mysqli_fetch_array($result3))
           {
              $user =$row3['iid'];
           }
      ?>

      <!-- get count Inbound Requests php code start -->
        <?php
           $view_status ="request";

           $queryir ="SELECT COUNT(id) as iid FROM jobs WHERE state='$view_status'";
           $resultir =mysqli_query($conn,$queryir);
           while ($rowir =mysqli_fetch_array($resultir))
           {
              $inre =$rowir['iid'];
           }
        ?>
      <!-- get count Inbound Requests php code end -->

      <!-- get count Rejected  php code start -->
        <?php
           //$view_status ="reject";

           $queryr ="SELECT COUNT(id) as iid FROM jobs WHERE state='design' OR state='production' OR state='QA'";
           $resultr =mysqli_query($conn,$queryr);
           while ($rowr =mysqli_fetch_array($resultr))
           {
              $ass =$rowr['iid'];
           }
        ?>
      <!-- get count Rejected php code end -->

      <!-- get count Dispatch  php code start -->
        <?php
           $view_status ="dispatch";

           $queryd ="SELECT COUNT(id) as iid FROM jobs WHERE state='$view_status'";
           $resultd =mysqli_query($conn,$queryd);
           while ($rowd =mysqli_fetch_array($resultd))
           {
              $dis =$rowd['iid'];
           }
        ?>
      <!-- get count Dispatch php code end -->

      <!-- get count Complete  php code start -->
        <?php
           $view_status ="complete";

           $queryc ="SELECT COUNT(id) as iid FROM jobs WHERE state='$view_status'";
           $resultc =mysqli_query($conn,$queryc);
           while ($rowc =mysqli_fetch_array($resultc))
           {
              $com =$rowc['iid'];
           }
        ?>

         <?php
           $view_status ="reject";

           $queryr ="SELECT COUNT(id) as iid FROM jobs WHERE state='$view_status'";
           $resultr =mysqli_query($conn,$queryr);
           while ($rowr =mysqli_fetch_array($resultr))
           {
              $rej =$rowr['iid'];
           }
        ?>
      <!-- get count Complete php code end -->


      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100" style="background-color: #1fb642;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5"> Create New Job</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="inbound_requests">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100" style="background-color: #e51b31;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5"> Billing Details</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="billing">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100" style="background-color: #283fa7;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"> Customer Database</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="customer">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white o-hidden h-100" style="background-color: #f4760f;">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5"> Add Users</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="setting">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div> <!-- end of 1st row-->

      <div class="row">
        <div class="col-xl-4 col-sm-4 col-md-4">
          <div class="card" style="background-color: #ebebe0;">
            <div class = "card-body">
              <p><b>ACTIVITIES</b></p><hr>
              <table style="width:100%;" cellpadding="6">
                <tr style="border-bottom: 2px solid white;">
                  <td>
                    <a href="jobs" style="text-decoration: none">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> See All the job list</a>
                  </td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td>
                    <a href="daily_sales" style="text-decoration: none">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> See About Sales</a>
                  </td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td>
                    <a href="#" style="text-decoration: none" data-toggle="modal" data-target="#myModal_type">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> Add New Job Type</a>
                  </td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td>
                    <a href="#" style="text-decoration: none" data-toggle="modal" data-target="#myModal_product">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> Add New Product</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="#" style="text-decoration: none" data-toggle="modal" data-target="#myModal_category">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> Add new Category</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div> <!-- end of 1st column-->

<!-- modal for Add New Job type-->
<div id="myModal_type" class="modal fade">
  <div class="modal-dialog" style="max-width: 400px;">
    <div class="modal-content" style="height : auto;">
      <div class="modal-header" style="background-color: #507183;">
        <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW JOB TYPE</b></span>
        <button type="button" class="close" data-dismiss="modal" onclick="type_form_reset()">&times;</button>
      </div>
      <div class="modal-body" style="background-color: #d6e1e9;">
        <form id="jobtype_submit">

          <?php
          $qry_jobid = mysqli_query($conn, "SELECT id FROM jobs_type ORDER BY id DESC LIMIT 1");
          $get_id = mysqli_fetch_array($qry_jobid);
          $next_id = $get_id['id']+1;
          ?>

          <div class="col-sm-12">
            <label>Job Type No</label>
            <input type="text" name="job_id" id="job_id" value="<?php echo $next_id; ?>" class="form-control" style="margin-bottom: 10px;"/ readonly="">
          </div>
          <div class="col-sm-12">
            <label>Job Type</label>
            <input type="text" name="job_type" id="job_type" class="form-control" style="margin-bottom: 20px;"/>
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

<!-- modal for Add New Product-->
<div id="myModal_product" class="modal fade">
  <div class="modal-dialog" style="max-width: 400px;">
    <div class="modal-content" style="height : auto;">
      <div class="modal-header" style="background-color: #507183;">
        <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW PRODUCT</b></span>
        <button type="button" class="close" data-dismiss="modal" onclick="product_form_reset()">&times;</button>
      </div>
      <div class="modal-body" style="background-color: #d6e1e9;">
        <form id="product_submit">

          <?php
          $qry_proid = mysqli_query($conn, "SELECT id FROM product ORDER BY id DESC LIMIT 1");
          $get_id = mysqli_fetch_array($qry_proid);
          $next_proid = $get_id['id']+1;
          ?>

          <div class="col-sm-12">
            <label>Product No</label>
            <input type="text" name="pro_id" id="pro_id" value="<?php echo $next_proid; ?>" class="form-control" style="margin-bottom: 10px;"/ readonly="">
          </div>

          <div class="col-sm-12">
            <label>Select Job Type</label>
            <SELECT name="jtype" id="jtype" class="form-control" style="margin-bottom: 10px;">
              <option selected="" disabled="">Select Job Type</option>
              <?php
              $type = "SELECT *
                        FROM jobs_type";

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
            <button type="button" id="form_product_submit" name="form_product_submit"  onclick="ProductInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="snackbar"><p id="msg_view"></p></div>
</div>

<!-- modal for Add New Product Category-->
<div id="myModal_category" class="modal fade">
  <div class="modal-dialog" style="max-width: 400px;">
    <div class="modal-content" style="height : auto;">
      <div class="modal-header" style="background-color: #507183;">
        <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW PRODUCT CATEGORY</b></span>
        <button type="button" class="close" data-dismiss="modal" onclick="category_form_reset()">&times;</button>
      </div>
      <div class="modal-body" style="background-color: #d6e1e9;">
        <form id="category_submit">

          <?php
          $qry_catid = mysqli_query($conn, "SELECT id FROM category ORDER BY id DESC LIMIT 1");
          $get_id = mysqli_fetch_array($qry_catid);
          $next_catid = $get_id['id']+1;
          ?>

          <div class="col-sm-12">
            <label>Category No</label>
            <input type="text" name="cat_id" id="cat_id" value="<?php echo $next_catid; ?>" class="form-control" style="margin-bottom: 10px;"/ readonly="">
          </div>

          <div class="col-sm-12">
            <label>Select Job Type</label>
            <SELECT name="jptype" id="jptype" class="form-control" style="margin-bottom: 10px;">
              <option selected="" disabled="">Select Job Type</option>
              <?php
              $type = "SELECT *
                        FROM jobs_type";

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
            <label>Select Product</label>
            <SELECT name="pitem" id="pitem" class="form-control" style="margin-bottom: 10px;">
              <option selected="" disabled="">Select Job Type First</option>
            </SELECT>
          </div>

          <div class="col-sm-12">
            <label>Category Name</label>
            <input type="text" name="category" id="category" class="form-control" style="margin-bottom: 20px;"/>
          </div>
            
          <div class="col-sm-12">
            <button type="button" id="form_category_submit" name="form_category_submit"  onclick="CategoryInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="snackbar"><p id="msg_view"></p></div>
</div>

        <div class="col-xl-4 col-sm-4 col-md-4">
          <div class="card" style="background-color: #ebebe0;">
            <div class = "card-body">
              <h6>OPEN JOBS</h6><hr>
              <table>
                <tr style="border-bottom: 2px solid white;">
                  <td><a href="inbound_requests" style="text-decoration: none">New</a></td>
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:green; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$inre.'</label>';?></td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td><a href="design" style="text-decoration: none">Assigned</a></td>
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:orange; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$ass.'</label>';?></td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td><a href="dispatch" style="text-decoration: none">Ready to dispatch</a></td>
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:blue; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$dis.'</label>';?></td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td><a href="completed" style="text-decoration: none">Completed</a></td>
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:gray; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$com.'</label>';?></td>
                </tr>
                <tr>
                  <td><a href="rejected" style="text-decoration: none">Rejected</a></td>
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:red; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$rej.'</label>';?></td>
                </tr>
              </table>
            </div>
          </div>
        </div> <!-- end of 2nd column-->

        <div class="col-xl-4 col-sm-4 col-md-4">
          <div class="card" style="background-color: #ebebe0;">
            <div class = "card-body">
              <?php
                /* current date n time - different with server date n time*/

                // date_default_timezone_set('Asia/Colombo');

                $today = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                
                $date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                $preday =$date->modify('-6 day');
                
                $day1 = $preday->format('Y-m-d');
                $day2 = $today->format('Y-m-d');

                $get_users = mysqli_query($conn, "SELECT COUNT(id) AS no_of_jobs, accepted_by AS user FROM jobs WHERE date BETWEEN '$day1' AND '$day2' GROUP BY accepted_by");

              ?>
              <h6>JOBS RECEIVED THIS WEEK <br> <font size="2" color="#006622">
               <!--  <?php //echo $preday->format('l\, jS \of F').' - ' .$today->format('l\, jS \of F Y');?>  -->
                <?php echo $preday->format('F j').' - ' .$today->format('F j');?> 
              </font></h6>
              <table  style="width:100%;" cellpadding="6">
                <tr style="border-bottom: 2px solid white; margin-bottom: 5px;">
                  <th style="width:80%;"></th>
                  <th style="font-weight: 3px; color: black; font-size: 12px; text-align: right;">ACCEPTED</th>
                </tr>
                <?php
                 if(mysqli_num_rows($get_users)>0){
                  while($row_data = mysqli_fetch_array($get_users)){
                   echo '
                    <tr>
                      <td style="width: 80%;">'.$row_data['user'].'</td>
                      <td style="text-align: right;"><b>'.$row_data['no_of_jobs'].'</b></td>
                    </tr>' ;

                  }
                }
                ?>
              </table>
            </div>
          </div>
        </div><!-- end of 3rd column-->


      </div><!-- end of 2nd row-->




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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <!-- <script src="../vendor/chart.js/Chart.min.js"></script> -->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <!-- <script src="../js/sb-admin-charts.min.js"></script> -->
  </div>
</body>
</html>
<script>
//////reset/////
function type_form_reset(){
  document.getElementById("jobtype_submit").reset();
}
function product_form_reset(){
  document.getElementById("product_submit").reset();
}
function category_form_reset(){
  document.getElementById("category_submit").reset();
}
////////////// get items ///////////////////////
$("#jptype").on('change',function(){
  var type = $(this).val();
  if(type){
    
    $.get(
      "../functions/get_items.php",
      {type:type},
      function (data) { 
        $('#pitem').html(data);
      }
    );
       
  }else{
    $('#pitem').html('<option>Select Job Type First</option>');
  }
});

function TypeInsert() {

  var job_id =document.getElementById('job_id').value;
  var job_type =document.getElementById('job_type').value;

  var form_type_submit =document.getElementById('form_type_submit').name;

  if(job_id=='' || job_type==''){
    alert("Required field is empty!");
  }
  else {

   $.ajax({
     url:"../controller/product_controller.php",
     method:"POST",
     data:{job_id:job_id,job_type:job_type,form_type_submit:form_type_submit},
     success:function(data){

     // Message success call function
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

function ProductInsert() {

  var pro_id =document.getElementById('pro_id').value;
  var jtype =document.getElementById('jtype').value;
  var product =document.getElementById('product').value;

  var form_product_submit =document.getElementById('form_product_submit').name;

  if(pro_id=='' || jtype=='' || product==''){
    alert("Required field is empty!");
  }
  else {

   $.ajax({
     url:"../controller/product_controller.php",
     method:"POST",
     data:{pro_id:pro_id,jtype:jtype,product:product,form_product_submit:form_product_submit},
     success:function(data){

     // Message success call function
     myform1();
     $('#msg_view').html(data);

     }
  });
 }
 }
// Message success view for product insert
// function myform2() {
//    var x = document.getElementById("snackbar");
//    x.className = "show";
//    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

//    // Location refech
//    setTimeout(function(){location.reload(); },2500);
// }

function CategoryInsert() {

  var cat_id =document.getElementById('cat_id').value;
  var pitem =document.getElementById('pitem').value;
  var category =document.getElementById('category').value;

  var form_category_submit =document.getElementById('form_category_submit').name;

  if(cat_id=='' || pitem=='' || category==''){
    alert("Required field is empty!");
  }
  else {

   $.ajax({
     url:"../controller/product_controller.php",
     method:"POST",
     data:{cat_id:cat_id,pitem:pitem,category:category,form_category_submit:form_category_submit},
     success:function(data){

     // Message success call function
     myform1();
     $('#msg_view').html(data);

     }
  });
 }
 }
// Message success view for category insert
// function myform3() {
//    var x = document.getElementById("snackbar");
//    x.className = "show";
//    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2500);

//    // Location refech
//    setTimeout(function(){location.reload(); },2500);
// }
</script>
