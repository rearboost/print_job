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
           $view_status ="reject";

           $queryr ="SELECT COUNT(id) as iid FROM jobs WHERE state='$view_status'";
           $resultr =mysqli_query($conn,$queryr);
           while ($rowr =mysqli_fetch_array($resultr))
           {
              $rej =$rowr['iid'];
           }
        ?>
      <!-- get count Rejected php code end -->

      <!-- get count Dispatch  php code start -->
        <?php
           $view_status ="distpatch";

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
              <div class="mr-5"><?php echo $rej;?> On Progress Jobs</div>
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
      </div>
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
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>
    <script src="../js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
