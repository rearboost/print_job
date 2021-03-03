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
         $query = "SELECT * FROM jobs WHERE job_no LIKE '%".$search."%' ";
      }
      else
      {
      $query = "SELECT * FROM jobs ORDER BY id DESC";
      }

      $result = mysqli_query($conn ,$query);

      if(mysqli_num_rows($result)>0)
      {

      ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <div class="tablealign">
<!--  <script src="jquery.tabledit.min.js"></script> -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php include('../include/head.php'); ?>
  <table id="editable_table" class="table table table-striped">
   <thead>
    <tr>
     <th>#</th>
     <th>CUSTOMER</th>
     <th>ITEM</th>
     <th>ACCEPTED DATE</th>
     <th>STATUS</th>
     <th>ACCEPTED BY</th>
     <th></th>
     <th></th>
    </tr>
   </thead>
   <tbody>
   <?php
   $i=1;
   while($row = mysqli_fetch_array($result))
   {
    echo '
    <tr>
     <td>'.$row["job_no"].'</td>
     <td>'.$row["customer"].'</td>
     <td>'.$row["product"].'</td>
     <td>'.$row["date"].'</td>';
     if($row["state"]=="request"){
        echo 
        '<td> <label class="btn-sm" style="background-color:green; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."REQUEST".'</label></td>';

     }else if($row["state"]=="design" || $row["state"]=="production" || $row["state"]=="QA"){
        echo 
        '<td> <label class="btn-sm" style="background-color:orange; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."ASSIGN".'</label></td>';

     }else if($row["state"]=="dispatch"){
        echo 
        '<td> <label class="btn-sm" style="background-color:red; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."PRODUCTION".'</label></td>';

     }else if($row["state"]=="complete"){
        echo 
        '<td> <label class="btn-sm" style="background-color:blue; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."PRODUCTION".'</label></td>';

     }else if($row["state"]=="reject"){
        echo 
        '<td> <label class="btn-sm" style="background-color:gray; border: 0px; color: #ffffff; font-size: 12px; padding-top: 0px;">'."REJECT".'</label></td>';
     }
    echo '
     
     <td>'.$row["accepted_by"].'</td>

      <td><button type="button"  id="' .$row["id"].'" name="'.$row["id"].'" class="btn btn-primary btn-sm view_data" data-toggle="modal" data-target="#myModal" style="background-color: transparent; border: 0px; color: #007bff; font-size: 16px; padding-top: 0px;">View</button></td>

     <td style="width: 5%;"><a href="../controller/inbound_requests_controller?j_delete_id='.$row["id"].'" onclick="confirmation(event)">Delete</a></td>
    </tr>
     ';
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