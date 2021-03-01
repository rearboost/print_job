<?php
  // database Connection
  require '../include/config.php';
  session_start();

    // Logic Delete the  Rejected  use id start
   if (isset($_POST['reject_delete_id']))
    {
        $id = $_POST['reject_delete_id'];
        $query ="DELETE FROM  jobs WHERE id=?;";
        $stmt =mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
           echo "SQL Error";
        }
        else
        {
            mysqli_stmt_bind_param($stmt,"s",$id);
            $result =  mysqli_stmt_execute($stmt);
        }
    }
    // Logic Delete the  Rejected  use id end



    //Rejected Jobs php code strat
   if(isset($_POST['view_id']))
   {
     $val =$_POST['view_id'];
     $query_obj ="SELECT * FROM jobs WHERE id='".$val."'";
     $result_obj =mysqli_query($conn,$query_obj);

     $object_obj =mysqli_fetch_object($result_obj);
     echo json_encode($object_obj);

   }


 ?>
