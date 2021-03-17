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
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5"><?php echo $inre;?> Inbound Requests</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
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
              <div class="mr-5"><?php echo $customer;?> Customers</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
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
              <div class="mr-5"><?php echo $product;?> Products</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
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
              <div class="mr-5"><?php echo $user;?> Users</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
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
                    <a href="customer" style="text-decoration: none">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> See All Customers</a>
                  </td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td>
                    <a href="billing" style="text-decoration: none">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> See Billing Details</a>
                  </td>
                </tr>
                <tr style="border-bottom: 2px solid white;">
                  <td>
                    <a href="daily_sales" style="text-decoration: none">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> See About Sales</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="setting" style="text-decoration: none">
                    <i class="fa fa-hand-o-right" style="margin-right: 10px;"></i> Add new user</a>
                  </td>
                </tr>
              </table>


                  
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
                /* current date n time - different with server date n time*/
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
