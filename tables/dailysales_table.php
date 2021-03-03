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
  

  if(isset($_POST["year"]) && !empty($_POST["year"]))
  {
    $year   =$_POST["year"];
    $query = "SELECT dispatch_month AS column1, SUM(ad_pay_amount + payment) AS sales FROM jobs WHERE dispatch_year='$year' GROUP BY column1 HAVING sales>0";
  }
  else if(isset($_POST["year"]) && ($_POST["month"]))
  {
    $year    =$_POST["year"];
    $month  =$_POST["month"];
    $query = "SELECT dispatch_day AS column1, SUM(ad_pay_amount + payment) AS sales FROM jobs WHERE dispatch_year='$year' AND dispatch_month='$month' GROUP BY column1 HAVING sales>0";     
  }
   
  else if(isset($_POST["query"]))
  {    
    $date   =$_POST["query"];
    $query = "SELECT dispatch_day AS column1, SUM(ad_pay_amount + payment) AS sales FROM jobs WHERE dispatch_day='$date' HAVING sales>0";

  }
  else 
  {
    $query = "SELECT dispatch_year AS column1, SUM(ad_pay_amount + payment) AS sales FROM jobs GROUP BY column1 HAVING sales>0";
 
  }

  $result = mysqli_query($conn ,$query);

  if(mysqli_num_rows($result)>0)
  {
    ?>

 <div class="tablealign">
<!--  <script src="jquery.tabledit.min.js"></script> -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <table id="editable_table" class="table table table-striped">
   <thead>
    <tr>
     <th>Date / Month / Year</th>
     <th>Sales</th>
    </tr>
   </thead>
   <tbody>
   <?php
   $i=1;
   while($row = mysqli_fetch_array($result))
   {
    echo '
    <tr>
     <td>'.$row["column1"].'</td>
     <td>'.$row["sales"].'</td>';
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
</body>
</html>
 
