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
     $query = "SELECT * FROM customer WHERE customer_name LIKE '%".$search."%' ";

  }
  else
  {
     $query = "SELECT * FROM customer";
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
     <th>Customer Name</th>
     <th>Email</th>
     <th>Contact</th>
    </tr>
   </thead>
   <tbody>
   <?php
   $i=1;
   while($row = mysqli_fetch_array($result))
   {
    echo '
    <tr>
     <td>'.$row["customer_name"].'</td>
     <td>'.$row["contact"].'</td>
     <td>'.$row["address"].'</td>';
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
 
