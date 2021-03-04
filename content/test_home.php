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
  <link rel="shortcut icon" href="../icon/jobshop_logo.png" />
  <title>Job Shop -  Home</title>
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
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5"><?php echo $inre;?> Inbound Requests</div>
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
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5"><?php echo $ass;?> On Progress Jobs</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="rejected">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5"><?php echo $dis;?> Dispatch Jobs</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="dispatch">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5"><?php echo $com;?> Completed Jobs</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="completed">
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
              <a href="jobs" style="text-decoration: none">
              <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> See All the job list</a>
              <br><br><p><b>YOUR TASKS</b></p><hr>

              <button type="button" id="" name="" class="btn btn-success btn-sm submit_data" data-toggle="modal" data-target="#myModal1" style="background-color: transparent; border: 0px; color: #00b33c; font-size: 16px; padding-top: 0px;" ><font color="green"><b>+ </b></font>New Job Type</button><br>

              <button type="button" id="" name="" class="btn btn-success btn-sm submit_data" data-toggle="modal" data-target="#myModal2" style="background-color: transparent; border: 0px; color: #00b33c; font-size: 16px; padding-top: 0px;" ><font color="green"><b>+ </b></font>New Category</button><br>

              <button type="button" id="" name="" class="btn btn-success btn-sm submit_data" data-toggle="modal" data-target="#myModal3" style="background-color: transparent; border: 0px; color: #00b33c; font-size: 16px; padding-top: 0px;" ><font color="green"><b>+ </b></font>New Product</button>
                  
            </div>
          </div>
        </div> <!-- end of 1st column-->

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
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:red; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$dis.'</label>';?></td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td><a href="completed" style="text-decoration: none">Completed</a></td>
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:blue; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$com.'</label>';?></td>
                </tr>
                <tr>
                  <td><a href="rejected" style="text-decoration: none">Rejected</a></td>
                  <td style="padding-left: 100px;"><?php echo '<label class="btn-sm" style="background-color:gray; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'.$rej.'</label>';?></td>
                </tr>
              </table>
            </div>
          </div>
        </div> <!-- end of 2nd column-->

        <div class="col-xl-4 col-sm-4 col-md-4">
          <div class="card" style="background-color: #ebebe0;">
            <div class = "card-body">
              <?php
                $today = new DateTime(null, new DateTimeZone('Etc/GMT+8'));
                
                $date = new DateTime(null, new DateTimeZone('Etc/GMT+8'));
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


      <!-- modals-->
      <div id="myModal1" class="modal fade">
      <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">New Job Type</b></span>
            <button type="button" class="close" data-dismiss="modal" onclick="form_reset1()">&times;</button>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form id="type_submit">
              <?php
                $get_type_id = mysqli_query($conn, "SELECT id FROM jobs_type ORDER BY id DESC limit 1");
                $data1 = mysqli_fetch_array($get_type_id);
                $type_id = $data1['id']+1;
              ?>
                <div class="col-sm-12">
                  <label>Type Name</label>
                  <input type="hidden" name="type_id" id="type_id" value="<?php echo $type_id;?>" class="form-control view_customer" style="margin-bottom: 10px;" disabled/>
                  <input type="text" name="type_name" id="type_name" class="form-control view_customer" style="margin-bottom: 10px;"/>
                </div>
                <div class="col-sm-12">
                  <button type="button" id="form_type_submit" name="form_type_submit"  onclick="FormInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div id="snackbar"><p id="msg_view"></p></div>
      </div> <!--end of modal1 -->

      <div id="myModal2" class="modal fade">
      <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">New Category</b></span>
            <button type="button" class="close" data-dismiss="modal" onclick="form_reset2()">&times;</button>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form id="category_submit">
              <?php
                $get_category_id = mysqli_query($conn, "SELECT id FROM category ORDER BY id DESC limit 1");
                $data2 = mysqli_fetch_array($get_category_id);
                $cat_id = $data2['id']+1;
              ?>
                <div class="col-sm-12">
                  <label>Category Name</label>
                  <input type="hidden" name="category_id" id="category_id" value="<?php echo $cat_id;?>" class="form-control view_customer" style="margin-bottom: 10px;" disabled/>
                  <input type="text" name="category_name" id="category_name" class="form-control view_customer" style="margin-bottom: 10px;"/>
                </div>
                <div class="col-sm-12">
                  <button type="button" id="form_category_submit" name="form_category_submit"  onclick="FormInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div id="snackbar"><p id="msg_view"></p></div>
      </div> <!--end of modal2 -->

      <div id="myModal3" class="modal fade">
      <div class="modal-dialog" style="max-width: 400px;">
        <div class="modal-content" style="height : auto;">
          <div class="modal-header" style="background-color: #507183;">
            <span style="font-size: 23px; font-family: monospace;"><b style="color: white;letter-spacing: 1.3px;">NEW PRODUCT</b></span>
            <button type="button" class="close" data-dismiss="modal" onclick="form_reset3()">&times;</button>
          </div>
          <div class="modal-body" style="background-color: #d6e1e9;">
            <form id="item_submit">
              <?php
                $get_product_id = mysqli_query($conn, "SELECT id FROM product ORDER BY id DESC limit 1");
                $data3 = mysqli_fetch_array($get_product_id);
                $pro_id = $data3['id']+1;
              ?>
                <div class="col-sm-12">
                  <label>Product Name</label>
                  <input type="hidden" name="item_id" id="item_id" value="<?php echo $pro_id;?>" class="form-control view_customer" style="margin-bottom: 10px;" disabled/>
                  <input type="text" name="item_name" id="item_name" class="form-control view_customer" style="margin-bottom: 10px;"/>
                </div>
                <div class="col-sm-12">
                  <label>Select Job Type</label>
                    <SELECT name="job_type" id="job_type" class="form-control" style="margin-bottom: 10px;">
                      <option selected="" disabled="">Select Job Type</option>
                      <?php
                      $type = "SELECT *
                                FROM jobs_type";

                      $result = mysqli_query($conn,$type);
                      $numRows = mysqli_num_rows($result); 
       
                        if($numRows > 0) {
                          while($row = mysqli_fetch_assoc($result)) {

                          echo '<option value = "'.$row["id"].'"> '. $row['type'] .' </option>';
                            
                          }
                        }
                      ?>
                    </SELECT>
                </div>
                <div class="col-sm-12">
                  <label>Select Category</label>
                    <SELECT name="category" id="category" class="form-control" style="margin-bottom: 10px;">
                      <option selected="" disabled="">Select Category</option>
                      <?php
                      $category = "SELECT *
                                FROM category";

                      $result1 = mysqli_query($conn,$category);
                      $numRows1 = mysqli_num_rows($result); 
       
                        if($numRows1 > 0) {
                          while($row1 = mysqli_fetch_assoc($result1)) {

                          echo '<option value = "'.$row1["id"].'"> '. $row1['category'] .' </option>';
                            
                          }
                        }
                      ?>
                    </SELECT>
                </div>
                <div class="col-sm-12">
                  <button type="button" id="form_item_submit" name="form_item_submit"  onclick="FormInsert()" class="btn btn-primary" style="height: 35px; width: 100px; color: white; border-color: #2CA8FF; background-color: #2CA8FF; font-size: 15px;  padding: 4px 10px; margin-top: 0px; margin-left: 1.5%;">SUBMIT</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div id="snackbar"><p id="msg_view"></p></div>
      </div> <!--end of modal3 -->

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

function form_reset1(){
  document.getElementById("type_submit").reset();
}
function form_reset2(){
  document.getElementById("category_submit").reset();
}
function form_reset3(){
  document.getElementById("item_submit").reset();
}
</script>
