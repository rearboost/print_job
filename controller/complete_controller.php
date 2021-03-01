<?php
  // database Connection
  require '../include/config.php';
  session_start();

    //Complete php code strat
   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT * FROM jobs WHERE id='".$val."'";
     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }

   //Note php code strat
  if(isset($_POST['view_note']))
  {
    $val =$_POST['view_note'];

    ?>

      <form method="post" id="invest_form_view">
       <?php
         $query = "SELECT * FROM noteinfor WHERE jobid='$val'";
         $result = mysqli_query($conn ,$query);
       ?>
       <style>
         .table-bordered td, .table-bordered th{
           border: 1px solid #000000;
         }
       </style>
       <table class="table table-bordered">
        <tr>
          <th style="width: 0.02%;">No</th>
          <th style="width: 5%;">Note</th>
        </tr>
        <tr>
          <?php
           $i =1;
            while($row = mysqli_fetch_array($result))
            {
             echo '
             <tr>
                <td>'.$i.'</td>
                <td>'.$row["note"].'</td>
             </tr>
             ';
             $i++;
            }
          ?>
        </tr>
       </table>
     </form>
    <?php
  }

 ?>
