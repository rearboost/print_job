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
  
  
  //$month  =$_POST["query2"];
  //$year   =$_POST["query3"];

  if(isset($_POST["query"]))
  {    
  $date   =$_POST["query"];
  $query = "SELECT dispatch_day AS column1, SUM(payment) AS sales FROM jobs WHERE dispatch_day='$date' GROUP BY column1 HAVING sales>0";

  }
  // else if(isset($_POST["query3"]))
  // {
  //   $query = "SELECT month AS column1, SUM(payment) AS sales FROM jobs GROUP BY month HAVING sales>0 ";
  // }
  // else if(isset($_POST["query2"])&&isset($_POST["query3"]))
  // {
  //   $query = "SELECT date AS column1, SUM(payment) AS sales FROM jobs GROUP BY date HAVING sales>0 ";
  // }
  else 
  {
    //$query = "SELECT MAX(dispatch_year) AS max_year, dispatch_month AS column1, SUM(payment) AS sales FROM jobs WHERE dispatch_year='max_year' GROUP BY column1 HAVING sales>0";
    
    $query = "SELECT dispatch_year AS max_year, dispatch_month AS column1, SUM(payment) AS sales FROM jobs GROUP BY column1 HAVING sales>0 ORDER BY dispatch_year DESC LIMIT 1";
    
    
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
 
